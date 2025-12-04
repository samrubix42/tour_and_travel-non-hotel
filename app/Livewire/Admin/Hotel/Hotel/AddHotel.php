<?php

namespace App\Livewire\Admin\Hotel\Hotel;

use App\Models\Destination;
use App\Models\Hotel as HotelModel;
use App\Models\HotelCategory;
use App\Models\HotelGallery;
use Illuminate\Support\Facades\Storage;
use App\Services\ImageKitService;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;


class AddHotel extends Component
{
    use WithFileUploads;

    public $name;
    public $slug;
    public $category_id;
    public $destination_id;
    public $address;
    public $phone;
    public $email;
    public $rating;
    public $description;
    public $long_description;
    public $map_embed;
    public $image;
    public $gallery = [];
    public $status = true;
    public $amenities = [];
    public $facilities = [];
    public $meta_title;
    public $meta_description;
    public $meta_keywords;

    public $categories = [];
    public $destinations = [];

    public function mount()
    {
        $this->loadLists();
    }

    public function addAmenity()
    {
        $this->amenities[] = '';
    }

    public function removeAmenity($index)
    {
        if (isset($this->amenities[$index])) {
            array_splice($this->amenities, $index, 1);
        }
    }

    public function addFacility()
    {
        $this->facilities[] = '';
    }

    public function removeFacility($index)
    {
        if (isset($this->facilities[$index])) {
            array_splice($this->facilities, $index, 1);
        }
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
            'rating' => 'nullable|numeric|min:0|max:5',
            'description' => 'nullable|string',
            'long_description' => 'nullable|string',
            'map_embed' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'gallery' => 'nullable|array',
            'gallery.*' => 'nullable|image|max:2048',
            'status' => 'boolean',
        ];
    }
    public function updatedName($value)
    {

        $this->slug = Str::slug($value);
    }

    public function loadLists()
    {
        $this->categories = HotelCategory::where('status', 1)->get();
        $this->destinations = Destination::where('status', 1)->get();
    }

    public function saveHotel()
    {
        $data = $this->validate();

        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($this->name);
        }

        // handle main image (ImageKit if configured, otherwise local storage)
        if ($this->image) {
            $ik = null;
            if (env('IMAGEKIT_PRIVATE_KEY')) {
                $ik = new ImageKitService();
            }
            try {
                if ($ik) {
                    $resp = $ik->uploadToFolder($this->image->getRealPath(), $this->image->getClientOriginalName(), '/hotels');
                    $fileId = $resp->result->fileId ?? null;
                    $url = $resp->result->url ?? null;
                    $data['image_url'] = $url;
                    $data['imagekit_file_id'] = $fileId;
                    $data['storage_path'] = null;
                } else {
                    $path = $this->image->store('hotels', 'public');
                    $data['storage_path'] = $path;
                    $data['image_url'] = Storage::url($path);
                    $data['imagekit_file_id'] = null;
                }
            } catch (\Exception $e) {
                // fallback: do not block creation if image upload fails
                $data['image_url'] = null;
                $data['storage_path'] = null;
                $data['imagekit_file_id'] = null;
            }
        }

        // amenities & facilities are arrays (from dynamic inputs)
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

        // remove uploaded file objects from data before inserting
        if (isset($data['image'])) unset($data['image']);
        if (isset($data['gallery'])) unset($data['gallery']);

        try {
            $hotel = HotelModel::create($data);
        } catch (\Exception $e) {
            // log and show friendly message
            logger()->error('Hotel create failed: ' . $e->getMessage());
            $this->dispatch('error', 'Failed to create hotel.');
            return;
        }

        // handle gallery uploads (local storage or ImageKit)
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
                    // skip individual failures but continue
                    continue;
                }
            }
        }

        $this->dispatch('success', 'Hotel created successfully.');
        return redirect()->route('admin.hotel.list');
    }

    #[Layout('components.layouts.admin')]
    #[Title('Add Hotel')]
    public function render()
    {
        return view('livewire.admin.hotel.hotel.add-hotel');
    }
}
