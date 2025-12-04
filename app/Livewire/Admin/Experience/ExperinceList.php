<?php

namespace App\Livewire\Admin\Experience;


use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Livewire\Attributes\Title;
use App\Models\Experience;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Services\ImageKitService;

class ExperinceList extends Component
{
    use WithPagination, WithFileUploads;

    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $perPage = 10;
    public $showModal = false;
    public $showDeleteModal = false;

    public $image; // temporary uploaded image
    public $currentImageUrl;

    public $experienceId;
    public $name;
    public $slug;
    public $status = true;
    public $imagekit_file_id;
    public $storage_path;

    protected function rules()
    {
        $uniqueRule = $this->experienceId ? "unique:experiences,slug,{$this->experienceId}" : 'unique:experiences,slug';
        return [
            'name' => 'required|string|max:255',
            'slug' => ['required', 'string', 'max:255', $uniqueRule],
            'status' => 'boolean',
            'image' => 'nullable|image|max:5120',
        ];
    }

    public function updatedName()
    {
        $this->slug = Str::slug($this->name);
    }

    #[Layout('components.layouts.admin')]
    #[Title('Experiences')]
    public function render()
    {
        $query = Experience::query();
        if ($this->search) {
            $query->where('name', 'like', "%{$this->search}%")
                  ->orWhere('slug', 'like', "%{$this->search}%");
        }
        $experiences = $query->orderBy('created_at', 'desc')->paginate($this->perPage);
        return view('livewire.admin.experience.experince-list', [
            'experiences' => $experiences,
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
        $exp = Experience::findOrFail($id);
        $this->experienceId = $exp->id;
        $this->name = $exp->name;
        $this->slug = $exp->slug;
        $this->status = (bool) $exp->status;
        $this->imagekit_file_id = $exp->imagekit_file_id ?? null;
        $this->storage_path = $exp->storage_path ?? null;
        $this->currentImageUrl = $exp->image ?? ($exp->storage_path ? Storage::url($exp->storage_path) : null);
        $this->showModal = true;
    }

    public function save()
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'slug' => $this->slug,
            'status' => $this->status,
        ];

        if ($this->experienceId) {
            $exp = Experience::findOrFail($this->experienceId);
            $exp->update($data);
        } else {
            $exp = Experience::create($data);
        }

        // image handling
        if ($this->image) {
            $useImageKit = env('IMAGEKIT_PRIVATE_KEY') && env('IMAGEKIT_URL_ENDPOINT');
            try {
                if ($useImageKit) {
                    $ik = new ImageKitService();
                    $upload = $ik->uploadToFolder($this->image->getRealPath(), $this->image->getClientOriginalName(), '/experiences');
                    $dataIk = is_array($upload) ? $upload : json_decode(json_encode($upload), true);
                    $url = $dataIk['result']['url'] ?? $dataIk['result']['filePath'] ?? null;
                    $fileId = $dataIk['result']['fileId'] ?? null;

                    $exp->update([
                        'image' => $url,
                        'imagekit_file_id' => $fileId,
                        'storage_path' => null,
                    ]);
                } else {
                    throw new \Exception('no imagekit');
                }
            } catch (\Exception $e) {
                // fallback to local storage
                $path = $this->image->store('experiences', 'public');
                $url = Storage::url($path);
                $exp->update([
                    'image' => $url,
                    'storage_path' => $path,
                    'imagekit_file_id' => null,
                ]);
            }
        }

        $this->dispatch('success', $this->experienceId ? 'Experience updated successfully.' : 'Experience created successfully.');
        $this->closeModal();
        $this->resetPage();
    }

    public function confirmDelete($id)
    {
        $this->experienceId = $id;
        $this->showDeleteModal = true;
    }

    public function delete()
    {
        if ($this->experienceId) {
            $exp = Experience::find($this->experienceId);
            if ($exp) {
                if (!empty($exp->imagekit_file_id)) {
                    try {
                        $ik = new ImageKitService();
                        $ik->deleteFile($exp->imagekit_file_id);
                    } catch (\Exception $e) {
                        // ignore
                    }
                }
                if (!empty($exp->storage_path)) {
                    try { Storage::disk('public')->delete($exp->storage_path); } catch (\Exception $e) {}
                }
                $exp->delete();
                $this->dispatch('success', 'Experience deleted.');
            }
        }
        $this->showDeleteModal = false;
        $this->resetPage();
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->resetForm();
    }

    public function cancelDelete()
    {
        $this->showDeleteModal = false;
        $this->experienceId = null;
    }

    protected function resetForm()
    {
        $this->experienceId = null;
        $this->name = null;
        $this->slug = null;
        $this->status = true;
        $this->image = null;
        $this->imagekit_file_id = null;
        $this->storage_path = null;
        $this->currentImageUrl = null;
        $this->resetValidation();
    }
}
