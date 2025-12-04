<?php

namespace App\Livewire\Admin\Destination;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Destination;
use App\Models\Category;
use App\Services\ImageKitService;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

class DestinationList extends Component
{
    use WithPagination, WithFileUploads;

    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $perPage = 10;

    public $showModal = false;
    public $showDeleteModal = false;

    public $destinationId;
    public $name;
    public $slug;
    public $description;
    public $status = true;
    public $is_featured = false;

    public $image;            // ImageKit or local URL
    public $storage_path;     // Local storage path
    public $imagekit_file_id; // ImageKit fileId
    public $imageFile;        // Livewire temporary upload
    public $categoryIds = [];

    protected function rules()
    {
        $uniqueRule = $this->destinationId
            ? "unique:destinations,slug,{$this->destinationId}"
            : 'unique:destinations,slug';

        return [
            'name' => 'required|string|max:255',
            'slug' => ['required', 'string', 'max:255', $uniqueRule],
            'description' => 'nullable|string',
            'status' => 'boolean',
            'is_featured' => 'boolean',
            'categoryIds' => 'required|array|min:1',
            'categoryIds.*' => 'integer|exists:categories,id',
            'imageFile' => 'nullable|image|max:1024',
        ];
    }
    public function updatedName()
    {
        $this->slug = Str::slug($this->name);
    }

    #[Layout('components.layouts.admin')]
    #[Title('Destinations')]
    public function render()
    {
        $query = Destination::query();

        if ($this->search) {
            $query->where('name', 'like', "%{$this->search}%")
                ->orWhere('slug', 'like', "%{$this->search}%");
        }

        $destinations = $query->orderBy('created_at', 'desc')->paginate($this->perPage);
        $categories = Category::where('status', 1)->orderBy('name')->get();

        return view('livewire.admin.destination.destination-list', [
            'destinations' => $destinations,
            'categories' => $categories,
        ]);
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function create()
    {
        $this->resetForm();
        $this->showModal = true;
    }

    public function edit($id)
    {
        $d = Destination::findOrFail($id);

        $this->destinationId = $d->id;
        $this->name = $d->name;
        $this->slug = $d->slug;
        $this->description = $d->description;
        $this->status = $d->status;
        $this->is_featured = $d->is_featured;
        $this->image = $d->image;
        $this->storage_path = $d->storage_path;
        $this->imagekit_file_id = $d->imagekit_file_id;
        $this->categoryIds = $d->categories()->pluck('categories.id')->toArray();

        $this->showModal = true;
    }

    public function save()
    {
        $this->validate();
        $this->status = $this->status ? 1 : 0;

        $data = [
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'status' => $this->status,
            'is_featured' => $this->is_featured,
        ];

        if ($this->imageFile) {
            $uploaded = null;
            $fileId = null;

            // Try ImageKit upload
            try {
                $ik = app(ImageKitService::class);
                $res = $ik->uploadToFolder(
                    $this->imageFile->getRealPath(),
                    $this->imageFile->getClientOriginalName(),
                    '/destinations'
                );

                if (is_object($res)) {
                    $uploaded = $res->result->url ?? null;
                    $fileId = $res->result->fileId ?? null;
                } elseif (is_array($res)) {
                    $uploaded = $res['result']['url'] ?? null;
                    $fileId = $res['result']['fileId'] ?? null;
                }
            } catch (\Throwable $e) {
                $uploaded = null;
                $fileId = null;
            }

            if ($uploaded) {
                $data['image'] = $uploaded;
                $data['imagekit_file_id'] = $fileId;
                $data['storage_path'] = null;
            } else {
                $path = $this->imageFile->store('destinations', 'public');
                $data['storage_path'] = $path;
                $data['image'] = asset('storage/' . $path);
                $data['imagekit_file_id'] = null;
            }

            // Delete old files only on update
            if ($this->destinationId) {
                $dest = Destination::findOrFail($this->destinationId);

                // Delete old local file
                if ($dest->storage_path) {
                    try {
                        Storage::disk('public')->delete($dest->storage_path);
                    } catch (\Throwable $e) {
                    }
                }

                // Delete old ImageKit file
                if ($dest->imagekit_file_id) {
                    try {
                        app(ImageKitService::class)->deleteFile($dest->imagekit_file_id);
                    } catch (\Throwable $e) {
                    }
                }
            }
        }

        if ($this->destinationId) {
            $dest = Destination::findOrFail($this->destinationId);
            $dest->update($data);
            try {
                $dest->categories()->sync($this->categoryIds);
            } catch (\Throwable $e) {
            }
           $this->dispatch('success', 'Destination updated successfully.');
        } else {
            $dest = Destination::create($data);
            try {
                $dest->categories()->sync($this->categoryIds);
            } catch (\Throwable $e) {
            }
           $this->dispatch('success', 'Destination created successfully.');
        }

        $this->closeModal();
        $this->resetPage();
    }

    public function confirmDelete($id)
    {
        $this->destinationId = $id;
        $this->showDeleteModal = true;
    }

    public function delete()
    {
        // Only delete database record, not images
        if ($this->destinationId) {
            $d = Destination::find($this->destinationId);
            if ($d) {
                $d->delete();
               $this->dispatch('success', 'Destination deleted.');
            }
        }

        $this->showDeleteModal = false;
        $this->resetPage();
    }

    public function cancelDelete()
    {
        $this->showDeleteModal = false;
        $this->destinationId = null;
    }

    public function toggleStatus($id)
    {
        $d = Destination::findOrFail($id);
        $d->status = $d->status ? 0 : 1;
        $d->save();
       $this->dispatch('success', 'Destination status updated.');
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->resetForm();
    }

    protected function resetForm()
    {
        $this->destinationId = null;
        $this->name = null;
        $this->slug = null;
        $this->description = null;
        $this->status = 1;
        $this->is_featured = false;
        $this->image = null;
        $this->storage_path = null;
        $this->imagekit_file_id = null;
        $this->imageFile = null;
        $this->categoryIds = [];
        $this->resetValidation();
    }
}
