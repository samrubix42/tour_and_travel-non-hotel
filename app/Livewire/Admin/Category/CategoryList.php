<?php

namespace App\Livewire\Admin\Category;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Services\ImageKitService;

class CategoryList extends Component
{
    use WithPagination, WithFileUploads;

    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $perPage = 10;
    public $showModal = false;
    public $showDeleteModal = false;

    public $categoryId;
    public $name;
    public $description;
    public $slug;
    public $status = true;
    public $category_image;
    public $imageFile;
    public $storage_path;
    public $imagekit_file_id;

    protected function rules()
    {
        $uniqueRule = $this->categoryId ? "unique:categories,slug,{$this->categoryId}" : 'unique:categories,slug';

        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'slug' => ['required', 'string', 'max:255', $uniqueRule],
            'status' => 'boolean',
            'imageFile' => 'nullable|image|max:1024',
        ];
    }

    public function updatedName()
    {
        $this->slug = Str::slug($this->name);
    }

    #[Layout('components.layouts.admin')]
    #[Title('Categories')]
    public function render()
    {
        $query = Category::query();
        if ($this->search) {
            $query->where('name', 'like', "%{$this->search}%")
                ->orWhere('slug', 'like', "%{$this->search}%");
        }

        $categories = $query->orderBy('created_at', 'desc')
            ->paginate($this->perPage);

        return view('livewire.admin.category.category-list', [
            'categories' => $categories,
        ]);
    }
 

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function create(): void
    {
        $this->resetForm();
        $this->showModal = true;
    }

    public function edit(int $id): void
    {
        $cat = Category::findOrFail($id);
        $this->categoryId = $cat->id;
        $this->name = $cat->name;
        $this->description = $cat->description;
        $this->slug = $cat->slug;
        $this->status = (bool) $cat->status;
        $this->category_image = $cat->category_image;
        $this->storage_path = $cat->storage_path;
        $this->imagekit_file_id = $cat->imagekit_file_id;

        $this->showModal = true;
    }

    public function save(): void
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'description' => $this->description,
            'slug' => $this->slug,
            'status' => $this->status,
        ];

        if ($this->imageFile) {
            $uploadedUrl = null;
            $fileId = null;
            $imageKit = null;
            $fileName = $this->imageFile->getClientOriginalName() ?? (time() . '-' . Str::slug($this->name) . '.' . $this->imageFile->extension());
            try {
                $imageKit = app(ImageKitService::class);
                $uploadResult = $imageKit->uploadToFolder(
                    $this->imageFile->getRealPath(),
                    $fileName,
                    '/categories'
                );
                if ($uploadResult) {
                    if (is_object($uploadResult)) {
                        $uploadedUrl = $uploadResult->result->url ?? null;
                        $fileId = $uploadResult->result->fileId ?? null;
                    } elseif (is_array($uploadResult)) {
                        $uploadedUrl = $uploadResult['result']['url'] ?? null;
                        $fileId = $uploadResult['result']['fileId'] ?? null;
                    }
                }
            } catch (\Throwable $e) {
                $uploadedUrl = null;
                $fileId = null;
                $imageKit = null;
            }

            if ($uploadedUrl) {
                $data['category_image'] = $uploadedUrl;
                $data['imagekit_file_id'] = $fileId;
                $data['storage_path'] = null;
            } else {
                $path = $this->imageFile->store('categories', 'public');
                $data['storage_path'] = $path;
                $data['category_image'] = asset('storage/' . $path);
                $data['imagekit_file_id'] = null;
            }

            // Delete old image if replacing
            if ($this->categoryId) {
                $existing = Category::findOrFail($this->categoryId);
                // Delete old local file
                if ($existing->storage_path) {
                    try { Storage::disk('public')->delete($existing->storage_path); } catch (\Throwable $e) {}
                }
                // Delete old ImageKit file
                if ($existing->imagekit_file_id && $imageKit) {
                    try { $imageKit->deleteFile($existing->imagekit_file_id); } catch (\Throwable $e) {}
                }
            }
        }

        if ($this->categoryId) {
            Category::findOrFail($this->categoryId)->update($data);
            $this->dispatch('success', 'Category updated successfully.');
        } else {
            Category::create($data);
            $this->dispatch('success', 'Category created successfully.');
        }

        $this->imageFile = null;
        $this->closeModal();
        $this->resetPage();
    }

    public function confirmDelete(int $id): void
    {
        $this->categoryId = $id;
        $this->showDeleteModal = true;
    }

    public function delete(): void
    {
        if ($this->categoryId) {
            Category::destroy($this->categoryId);
            $this->dispatch('success', 'Category deleted.');
        }
        $this->showDeleteModal = false;
        $this->resetPage();
    }

    public function toggleActive(int $id): void
    {
        $category = Category::findOrFail($id);
        $category->status = ! (bool) $category->status;
        $category->save();

        $this->dispatch('success', 'Category status updated.');
        $this->resetPage();
    }

    public function closeModal(): void
    {
        $this->showModal = false;
        $this->resetForm();
    }

    public function cancelDelete(): void
    {
        $this->showDeleteModal = false;
        $this->categoryId = null;
    }

    protected function resetForm(): void
    {
        $this->categoryId = null;
        $this->name = null;
        $this->description = null;
        $this->slug = null;
        $this->status = true;
        $this->category_image = null;
        $this->storage_path = null;
        $this->imagekit_file_id = null;
        $this->imageFile = null;
        $this->resetValidation();
    }
}
