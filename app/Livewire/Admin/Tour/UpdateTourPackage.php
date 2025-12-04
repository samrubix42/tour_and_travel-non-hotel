<?php

namespace App\Livewire\Admin\Tour;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\TourPackage;
use App\Models\Category;
use App\Models\Destination;
use App\Models\TourPackageGallery;
use App\Models\Experience;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Services\ImageKitService;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

class UpdateTourPackage extends Component
{
    use WithFileUploads;

    public $packageId;
    public $title;
    public $slug;
    public $meta_title;
    public $meta_description;
    public $meta_keywords;
    public $description;
    public $price;
    public $is_featured = false;
    public $featuredImage; 
    public $currentFeaturedUrl;
    public $currentFeaturedStoragePath;
    public $currentFeaturedImagekitFileId;

    public $category_ids = [];
    public $destination_ids = [];
    public $experience_ids = [];

    /** @var \Livewire\TemporaryUploadedFile[] */
    public $images = []; 
    public $galleries = []; 

    public $itineraryDays = [];
    public $includes = [];
    public $optional = [];

    protected function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:255',
            'meta_keywords' => 'nullable|string|max:255',
            'slug' => 'required|string|max:255|unique:tour_packages,slug,' . ($this->packageId ?? 'NULL'),
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'is_featured' => 'boolean',
            'category_ids' => 'required|array',
            'category_ids.*' => 'exists:categories,id',
            'destination_ids' => 'required|array',
            'destination_ids.*' => 'exists:destinations,id',
            'experience_ids' => 'required|array',
            'experience_ids.*' => 'exists:experiences,id',
            'images' => 'nullable|array',
            'images.*' => 'image|max:5120', // 5MB
            'featuredImage' => 'nullable|image|max:5120',
            'includes' => 'nullable|array',
            'includes.*' => 'nullable|string|max:255',
            'optional' => 'nullable|array',
            'optional.*' => 'nullable|string|max:255',
        ];
    }

    public function mount($id)
    {
        $package = TourPackage::findOrFail($id);

        $this->packageId = $package->id;
        $this->title = $package->title;
        $this->slug = $package->slug;
        $this->meta_title = $package->meta_title;
        $this->meta_description = $package->meta_description;
        $this->meta_keywords = $package->meta_keywords;
        $this->description = $package->description;
        $this->price = $package->price;
        $this->is_featured = (bool) $package->is_featured;

        $this->category_ids = $package->categories()->pluck('categories.id')->toArray();
        $this->destination_ids = $package->destinations()->pluck('destinations.id')->toArray();
        $this->experience_ids = $package->experiences()->pluck('experiences.id')->toArray();

        // hydrate itineraryDays from stored JSON
        if ($package->itinerary) {
            $decoded = @json_decode($package->itinerary, true);
            if (is_array($decoded)) {
                $this->itineraryDays = [];
                foreach ($decoded as $day) {
                    $this->itineraryDays[] = [
                        'title' => $day['title'] ?? '',
                        'points_text' => !empty($day['points']) ? implode("\n", $day['points']) : '',
                    ];
                }
            }
        }

        if (empty($this->itineraryDays)) {
            $this->itineraryDays = [['title' => '', 'points_text' => '']];
        }

        $this->galleries = $package->galleries()->get();

        $this->currentFeaturedUrl = $package->featured_image;
        $this->currentFeaturedStoragePath = $package->storage_path;
        $this->currentFeaturedImagekitFileId = $package->imagekit_file_id;

        if ($package->includes) {
            $decoded = @json_decode($package->includes, true);
            $this->includes = is_array($decoded) ? $decoded : [$package->includes];
        } else {
            $this->includes = [''];
        }

        if ($package->optional) {
            $decoded = @json_decode($package->optional, true);
            $this->optional = is_array($decoded) ? $decoded : [$package->optional];
        } else {
            $this->optional = [''];
        }
    }

    public function updatedTitle($value)
    {
        if (!$this->slug) {
            $this->slug = Str::slug($value);
        }
    }

    public function addItineraryDay()
    {
        $this->itineraryDays[] = ['title' => '', 'points_text' => ''];
    }

    public function addInclude()
    {
        $this->includes[] = '';
    }

    public function removeInclude($i)
    {
        if (isset($this->includes[$i])) array_splice($this->includes, $i, 1);
        if (empty($this->includes)) $this->includes = [''];
    }

    public function addOptional()
    {
        $this->optional[] = '';
    }

    public function removeOptional($i)
    {
        if (isset($this->optional[$i])) array_splice($this->optional, $i, 1);
        if (empty($this->optional)) $this->optional = [''];
    }

    public function removeItineraryDay($index)
    {
        if (isset($this->itineraryDays[$index])) {
            array_splice($this->itineraryDays, $index, 1);
        }
    }

    protected function prepareItinerary()
    {
        $result = [];
        foreach ($this->itineraryDays as $i => $d) {
            $dayKey = 'day' . ($i + 1);
            $points = [];
            if (!empty($d['points_text'])) {
                $lines = preg_split('/\r?\n/', $d['points_text']);
                foreach ($lines as $line) {
                    $t = trim($line);
                    if ($t !== '') $points[] = $t;
                }
            }
            $result[$dayKey] = [
                'title' => $d['title'] ?? '',
                'points' => $points,
            ];
        }
        return empty($result) ? null : json_encode($result);
    }

    /**
     * Remove selected new image before update
     */
    public function removeNewImage($index)
    {
        if (!isset($this->images[$index])) return;
        array_splice($this->images, $index, 1);
    }

    /**
     * Delete existing gallery image (remains on page, shows loading)
     */
    public function deleteGallery($id)
    {
        $g = TourPackageGallery::find($id);
        if (!$g) return;

        // delete remote (ImageKit) or local storage if present
        if ($g->imagekit_file_id) {
            try {
                $ik = new ImageKitService();
                $ik->deleteFile($g->imagekit_file_id);
            } catch (\Exception $e) {
                // ignore deletion errors
            }
        }

        if ($g->storage_path) {
            try {
                Storage::disk('public')->delete($g->storage_path);
            } catch (\Exception $e) {
                // ignore
            }
        }

        $g->delete();

        // refresh galleries for this package and stay on the same page
        $this->galleries = TourPackageGallery::where('tour_package_id', $this->packageId)->get();
    }

    /**
     * Set a gallery image as featured image for package
     */
    public function setFeaturedGallery($id)
    {
        $g = TourPackageGallery::find($id);
        if (!$g) return;

        $package = TourPackage::findOrFail($this->packageId);
        $package->update([
            'featured_image' => $g->image_url,
            'storage_path' => $g->storage_path,
            'imagekit_file_id' => $g->imagekit_file_id,
        ]);

        // to reflect change immediately (if needed)
        $this->galleries = TourPackageGallery::where('tour_package_id', $this->packageId)->get();

        // update current featured info
        $this->currentFeaturedUrl = $g->image_url;
        $this->currentFeaturedStoragePath = $g->storage_path;
        $this->currentFeaturedImagekitFileId = $g->imagekit_file_id;
    }

    public function update()
    {
        $this->validate();

        $itineraryJson = $this->prepareItinerary();

        $package = TourPackage::findOrFail($this->packageId);

        $package->update([
            'title' => $this->title,
            'slug' => $this->slug ?? Str::slug($this->title),
            'meta_title' => $this->meta_title,
            'meta_description' => $this->meta_description,
            'meta_keywords' => $this->meta_keywords,
            'itinerary' => $itineraryJson,
            'description' => $this->description,
            'price' => $this->price,
            'includes' => empty($this->includes) ? null : json_encode(array_values(array_filter($this->includes, fn($v)=>trim($v) !== ''))),
            'optional' => empty($this->optional) ? null : json_encode(array_values(array_filter($this->optional, fn($v)=>trim($v) !== ''))),
            'is_featured' => (bool)$this->is_featured,
        ]);

        // sync relations
        $package->categories()->sync($this->category_ids ?? []);
        $package->destinations()->sync($this->destination_ids ?? []);
        $package->experiences()->sync($this->experience_ids ?? []);

        // Upload newly selected images (if any)
        if (!empty($this->images) && is_array($this->images)) {
            $useImageKit = env('IMAGEKIT_PRIVATE_KEY') && env('IMAGEKIT_URL_ENDPOINT');

            foreach ($this->images as $i => $img) {
                try {
                    if ($useImageKit) {
                        $ik = new ImageKitService();
                        $upload = $ik->uploadToFolder($img->getRealPath(), $img->getClientOriginalName(), '/tour_packages');
                        $data = is_array($upload) ? $upload : json_decode(json_encode($upload), true);
                        $url = $data['result']['url'] ?? $data['result']['filePath'] ?? null;
                        $fileId = $data['result']['fileId'] ?? null;

                        TourPackageGallery::create([
                            'tour_package_id' => $package->id,
                            'image_url' => $url,
                            'storage_path' => null,
                            'imagekit_file_id' => $fileId,
                        ]);

                        if ($i === 0 && !$package->featured_image) {
                            $package->update([ 'featured_image' => $url, 'imagekit_file_id' => $fileId ]);
                        }

                        continue;
                    }
                } catch (\Exception $e) {
                    // fallback to local storage
                }

                $path = $img->store('tour_packages', 'public');
                $url = Storage::url($path);

                TourPackageGallery::create([
                    'tour_package_id' => $package->id,
                    'image_url' => $url,
                    'storage_path' => $path,
                ]);

                if ($i === 0 && !$package->featured_image) {
                    $package->update([ 'featured_image' => $url, 'storage_path' => $path ]);
                }
            }
        }

        // Handle featured image replacement (if user uploaded one)
        if ($this->featuredImage) {
            // delete previous featured remote/local resources if present
            if ($this->currentFeaturedImagekitFileId) {
                try {
                    $ik = new ImageKitService();
                    $ik->deleteFile($this->currentFeaturedImagekitFileId);
                } catch (\Exception $e) {
                }
            }

            if ($this->currentFeaturedStoragePath) {
                try {
                    Storage::disk('public')->delete($this->currentFeaturedStoragePath);
                } catch (\Exception $e) {
                    // ignore
                }
            }

            // upload new featured image
            $useImageKit = env('IMAGEKIT_PRIVATE_KEY') && env('IMAGEKIT_URL_ENDPOINT');
            try {
                if ($useImageKit) {
                    $ik = new ImageKitService();
                    $upload = $ik->uploadToFolder($this->featuredImage->getRealPath(), $this->featuredImage->getClientOriginalName(), '/tour_packages');
                    $data = is_array($upload) ? $upload : json_decode(json_encode($upload), true);
                    $url = $data['result']['url'] ?? $data['result']['filePath'] ?? null;
                    $fileId = $data['result']['fileId'] ?? null;

                    $package->update([
                        'featured_image' => $url,
                        'imagekit_file_id' => $fileId,
                        'storage_path' => null,
                    ]);

                    $this->currentFeaturedUrl = $url;
                    $this->currentFeaturedImagekitFileId = $fileId;
                    $this->currentFeaturedStoragePath = null;
                } else {
                    throw new \Exception('no imagekit');
                }
            } catch (\Exception $e) {
                $path = $this->featuredImage->store('tour_packages', 'public');
                $url = Storage::url($path);
                $package->update([
                    'featured_image' => $url,
                    'storage_path' => $path,
                    'imagekit_file_id' => null,
                ]);

                $this->currentFeaturedUrl = $url;
                $this->currentFeaturedStoragePath = $path;
                $this->currentFeaturedImagekitFileId = null;
            }
        }

        // refresh galleries and clear newly selected images after upload
        $this->galleries = TourPackageGallery::where('tour_package_id', $this->packageId)->get();
        $this->images = [];

       $this->dispatch('success', 'Tour package updated successfully!');
        return redirect()->route('admin.tour.package.list');
    }

    #[Layout('components.layouts.admin')]
    #[Title('Update Tour Package')]
    public function render()
    {
        return view('livewire.admin.tour.update-tour-package', [
            'allCategories' => Category::all(),
            'allDestinations' => Destination::all(),
            'allExperiences' => Experience::all(),
        ]);
    }
}
