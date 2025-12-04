<?php

namespace App\Livewire\Admin\Banner;

use Livewire\Component;
use App\Models\Banner;
use App\Services\ImageKitService;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class BannerManagement extends Component
   
{
    use WithFileUploads;
     public $deleteId = null;
    public $isLoading = false;
    public $banners;
    public $editId = null;
    public $title, $subtitle, $image, $button_text, $button_url, $status = true;
    public $image_url, $storage_path, $imagekit_file_id;

    protected $rules = [
        'title' => 'required|string|max:255',
        'subtitle' => 'nullable|string|max:255',
        'image' => 'required|image|max:2048',
        'button_text' => 'required|string|max:255',
        'button_url' => 'nullable|string|max:255',
        'status' => 'boolean',
    ];

    public function mount()
    {
        $this->loadBanners();
    }

    public function loadBanners()
    {
        $this->banners = Banner::orderByDesc('id')->get();
    }

    public function edit($id)
    {
        $banner = Banner::findOrFail($id);
        $this->editId = $id;
        $this->title = $banner->title;
        $this->subtitle = $banner->subtitle;
        $this->button_text = $banner->button_text;
        $this->button_url = $banner->button_url;
        $this->status = $banner->status;
        $this->image_url = $banner->image_url;
        $this->storage_path = $banner->storage_path;
        $this->imagekit_file_id = $banner->imagekit_file_id;
    }

    public function save()
    {
        $this->isLoading = true;
        $this->validate();
        $data = [
            'title' => $this->title,
            'subtitle' => $this->subtitle,
            'button_text' => $this->button_text,
            'button_url' => $this->button_url,
            'status' => $this->status,
        ];

        if ($this->image) {
            try {
                $imageKitEnabled = env('IMAGEKIT_PUBLIC_KEY') && env('IMAGEKIT_PRIVATE_KEY') && env('IMAGEKIT_URL_ENDPOINT');
                // Delete old image if editing
                if ($this->editId) {
                    $old = Banner::find($this->editId);
                    if ($old) {
                        if ($imageKitEnabled && $old->imagekit_file_id) {
                            $service = new ImageKitService();
                            $service->deleteFile($old->imagekit_file_id);
                        } elseif ($old->storage_path) {
                            Storage::disk('public')->delete($old->storage_path);
                        }
                    }
                }
                if ($imageKitEnabled) {
                    $service = new ImageKitService();
                    $result = $service->uploadToFolder($this->image->getRealPath(), $this->image->getClientOriginalName(), '/banners');
                    $data['image_url'] = $result->result->url ?? null;
                    $data['storage_path'] = $result->result->filePath ?? null;
                    $data['imagekit_file_id'] = $result->result->fileId ?? null;
                } else {
                    $path = $this->image->store('banners', 'public');
                    $data['image_url'] = asset('storage/' . $path);
                    $data['storage_path'] = $path;
                    $data['imagekit_file_id'] = null;
                }
            } catch (\Exception $e) {
                $this->addError('image', 'Image upload failed: ' . $e->getMessage());
                $this->isLoading = false;
                return;
            }
        }

        if ($this->editId) {
            Banner::where('id', $this->editId)->update($data);
        } else {
            Banner::create($data);
        }
        $this->resetForm();
        $this->loadBanners();
        $this->isLoading = false;
    }

    public function confirmDelete($id)
    {
        $this->deleteId = $id;
    }

    public function delete()
    {
        $banner = Banner::find($this->deleteId);
        if ($banner) {
            $imageKitEnabled = env('IMAGEKIT_PUBLIC_KEY') && env('IMAGEKIT_PRIVATE_KEY') && env('IMAGEKIT_URL_ENDPOINT');
            if ($imageKitEnabled && $banner->imagekit_file_id) {
                $service = new ImageKitService();
                $service->deleteFile($banner->imagekit_file_id);
            } elseif ($banner->storage_path) {
                Storage::disk('public')->delete($banner->storage_path);
            }
            $banner->delete();
        }
        $this->deleteId = null;
        $this->loadBanners();
    }

    public function resetForm()
    {
        $this->editId = null;
        $this->title = null;
        $this->subtitle = null;
        $this->image = null;
        $this->button_text = null;
        $this->button_url = null;
        $this->status = true;
        $this->image_url = null;
        $this->storage_path = null;
        $this->imagekit_file_id = null;
        $this->isLoading = false;
    }

    #[Layout('components.layouts.admin')]
    #[Title('Banners')]
    public function render()
    {
        return view('livewire.admin.banner.banner-management');
    }
}
