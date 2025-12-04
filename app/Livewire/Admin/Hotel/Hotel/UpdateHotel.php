<?php

namespace App\Livewire\Admin\Hotel\Hotel;

use App\Models\Hotel as HotelModel;
use App\Models\Destination;
use App\Models\HotelCategory;
use App\Models\HotelGallery;
use Illuminate\Support\Facades\Storage;
use App\Services\ImageKitService;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Title;

class UpdateHotel extends Component
{
    use WithFileUploads;

    public $hotelId;
    public $name;
    public $slug;
    public $category_id;
    public $destination_id;
    public $address;
    public $phone;
    public $email;
    public $rating;
    public $description;
    public $image;
    public $existingImageUrl;
    public $existingImagePath;
    public $existingImageKitId;
    public $status = true;
    public $gallery = [];
    public $existingGalleries = [];
    public $amenities = [];
    public $facilities = [];
    public $meta_title;
    public $meta_description;
    public $meta_keywords;
    public $long_description;
    public $map_embed;

    public $categories = [];
    public $destinations = [];

    public function mount($id)
    {
        $this->hotelId = $id;
        $this->loadLists();
        $this->loadForEdit($id);
    }

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'category_id' => 'required|integer',
            'destination_id' => 'required|integer',
            'address' => 'nullable|string|max:1000',
            'phone' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'amenities' => 'nullable|array',
            'amenities.*' => 'nullable|string|max:255',
            'facilities' => 'nullable|array',
            'facilities.*' => 'nullable|string|max:255',
            'gallery' => 'nullable|array',
            'gallery.*' => 'nullable|image|max:2048',
            'rating' => 'nullable|numeric|min:0|max:5',
            'description' => 'nullable|string',
            'long_description' => 'nullable|string',
            'map_embed' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'status' => 'boolean',
        ];
    }
    public function updatedName()
    {

        $this->slug = Str::slug($this->name);
    }

    public function loadLists()
    {
        $this->categories = HotelCategory::where('status', 1)->get();
        $this->destinations = Destination::where('status', 1)->get();
    }

    public function loadForEdit($id)
    {
        $hotel = HotelModel::find($id);
        if (!$hotel) return;

        $this->hotelId = $hotel->id;
        $this->name = $hotel->name;
        $this->slug = $hotel->slug;
        $this->category_id = $hotel->category_id;
        $this->destination_id = $hotel->destination_id;
        $this->address = $hotel->address;
        $this->rating = $hotel->rating;
        $this->description = $hotel->description;
        $this->existingImageUrl = $hotel->image_url;
        $this->existingImagePath = $hotel->storage_path;
        $this->existingImageKitId = $hotel->imagekit_file_id;
        $this->status = (bool) $hotel->status;
        $this->phone = $hotel->phone;
        $this->email = $hotel->email;
        // load amenities/facilities as comma-separated string for the input
        // load amenities/facilities as arrays
        if (!empty($hotel->amenities)) {
            if (is_string($hotel->amenities)) {
                $decoded = @json_decode($hotel->amenities, true);
                $this->amenities = is_array($decoded) ? $decoded : [trim($hotel->amenities)];
            } elseif (is_array($hotel->amenities)) {
                $this->amenities = $hotel->amenities;
            }
        }
        if (!empty($hotel->facilities)) {
            if (is_string($hotel->facilities)) {
                $decoded = @json_decode($hotel->facilities, true);
                $this->facilities = is_array($decoded) ? $decoded : [trim($hotel->facilities)];
            } elseif (is_array($hotel->facilities)) {
                $this->facilities = $hotel->facilities;
            }
        }
        $this->meta_title = $hotel->meta_title;
        $this->meta_description = $hotel->meta_description;
        $this->meta_keywords = $hotel->meta_keywords;
        $this->long_description = $hotel->long_description;
        $this->map_embed = $hotel->map_embed;
        // load existing galleries
        $this->existingGalleries = HotelGallery::where('hotel_id', $hotel->id)->get()->toArray();
    }

    public function saveHotel()
    {
        $data = $this->validate();

        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($this->name);
        }

        // handle main image upload (ImageKit preferred)
        if ($this->image) {
            $ik = null;
            if (env('IMAGEKIT_PRIVATE_KEY')) {
                $ik = new ImageKitService();
            }
            try {
                if ($ik) {
                    $resp = $ik->uploadToFolder($this->image->getRealPath(), $this->image->getClientOriginalName(), '/hotels');
                    $data['image_url'] = $resp->result->url ?? null;
                    $data['imagekit_file_id'] = $resp->result->fileId ?? null;
                    $data['storage_path'] = null;
                } else {
                    $path = $this->image->store('hotels', 'public');
                    $data['storage_path'] = $path;
                    $data['image_url'] = Storage::url($path);
                    $data['imagekit_file_id'] = null;
                }
            } catch (\Exception $e) {
                // ignore upload errors and preserve existing values
            }
        } else {
            // keep existing values
            $data['image_url'] = $this->existingImageUrl ?? null;
            $data['storage_path'] = $this->existingImagePath ?? null;
            $data['imagekit_file_id'] = $this->existingImageKitId ?? null;
        }

        // process amenities & facilities (we store as JSON)
        $data['amenities'] = !empty($this->amenities) ? json_encode(array_values(array_filter(array_map('trim', $this->amenities)))) : null;
        $data['facilities'] = !empty($this->facilities) ? json_encode(array_values(array_filter(array_map('trim', $this->facilities)))) : null;

        // phone, email and meta fields
        $data['phone'] = $this->phone ?? null;
        $data['email'] = $this->email ?? null;
        $data['long_description'] = $this->long_description ?? null;
        $data['map_embed'] = $this->map_embed ?? null;
        $data['meta_title'] = $this->meta_title ?? null;
        $data['meta_description'] = $this->meta_description ?? null;
        $data['meta_keywords'] = $this->meta_keywords ?? null;

        $data['status'] = isset($data['status']) ? (bool)$data['status'] : false;

        $hotel = HotelModel::find($this->hotelId);
        if ($hotel) {
            // remove uploaded file objects from data before updating model
            if (isset($data['image'])) unset($data['image']);
            if (isset($data['gallery'])) unset($data['gallery']);
            try {
                $hotel->update($data);
            } catch (\Exception $e) {
                logger()->error('Hotel update failed: ' . $e->getMessage());
                $this->dispatch('error', 'Failed to update hotel.');
                return;
            }
            // handle new gallery uploads
            if (!empty($this->gallery) && is_array($this->gallery)) {
                $ik = null;
                if (env('IMAGEKIT_PRIVATE_KEY')) {
                    $ik = new ImageKitService();
                }
                foreach ($this->gallery as $file) {
                    try {
                        if ($ik) {
                            $resp = $ik->uploadToFolder($file->getRealPath(), $file->getClientOriginalName(), '/hotels');
                            $fileId = $resp->result->fileId ?? null;
                            $url = $resp->result->url ?? null;
                            HotelGallery::create([
                                'hotel_id' => $hotel->id,
                                'image_url' => $url,
                                'imagekit_file_id' => $fileId,
                                'storage_path' => null,
                            ]);
                        } else {
                            $path = $file->store('hotels/galleries', 'public');
                            HotelGallery::create([
                                'hotel_id' => $hotel->id,
                                'image_url' => Storage::url($path),
                                'storage_path' => $path,
                                'imagekit_file_id' => null,
                            ]);
                        }
                    } catch (\Exception $e) {
                        continue;
                    }
                }
                // refresh list
                $this->existingGalleries = HotelGallery::where('hotel_id', $hotel->id)->get()->toArray();
            }
            $this->dispatch('success', 'Hotel updated successfully.');
        }

        return redirect()->route('admin.hotel.list');
    }

    #[\Livewire\Attributes\Layout('components.layouts.admin')]
    #[\Livewire\Attributes\Title('Update Hotel')]
    public function render()
    {
        return view('livewire.admin.hotel.hotel.update-hotel');
    }

    public function removeGallery($id)
    {
        $gallery = HotelGallery::find($id);
        if (!$gallery) return;

        // delete from ImageKit if present
        try {
            if (!empty($gallery->imagekit_file_id) && env('IMAGEKIT_PRIVATE_KEY')) {
                $ik = new ImageKitService();
                $ik->deleteFile($gallery->imagekit_file_id);
            }
        } catch (\Exception $e) {
            // ignore
        }

        // delete local storage
        try {
            if (!empty($gallery->storage_path)) {
                Storage::disk('public')->delete($gallery->storage_path);
            }
        } catch (\Exception $e) {
            // ignore
        }

        $gallery->delete();
        $this->existingGalleries = HotelGallery::where('hotel_id', $this->hotelId)->get()->toArray();
    }
}
