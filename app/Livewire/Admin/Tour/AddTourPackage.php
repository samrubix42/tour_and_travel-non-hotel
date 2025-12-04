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

class AddTourPackage extends Component
{
    use WithFileUploads;

    public $title;
    public $slug;
    public $itinerary;
    public $meta_title;
    public $meta_description;
    public $meta_keywords;
    public $description;
    public $price;
    public $is_featured = false;
    public $featuredImage;

    public $category_ids = [];
    public $destination_ids = [];
    public $experience_ids = [];

    /** @var \Livewire\TemporaryUploadedFile[] */
    public $images = [];

    public $itineraryDays = [];
    public $includes = [];
    public $optional = [];

    protected $rules = [
        'title' => 'required|string|max:255',
        'meta_title' => 'nullable|string|max:255',
        'meta_description' => 'nullable|string|max:255',
        'meta_keywords' => 'nullable|string|max:255',
        'slug' => 'required|string|max:255|unique:tour_packages,slug',
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
        'images.*' => 'image|max:5120', // 5MB each
        'featuredImage' => 'nullable|image|max:5120',
        'includes' => 'nullable|array',
        'includes.*' => 'nullable|string|max:255',
        'optional' => 'nullable|array',
        'optional.*' => 'nullable|string|max:255',
    ];

    public function mount()
    {
        // ensure at least one itinerary day exists
        if (empty($this->itineraryDays)) {
            $this->itineraryDays = [['title' => '', 'points_text' => '']];
        }

        if (empty($this->includes)) $this->includes = [''];
        if (empty($this->optional)) $this->optional = [''];
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

    public function UpdatedTitle($value)
    {
        $this->slug = Str::slug($value);
    }

    public function addItineraryDay()
    {
        $this->itineraryDays[] = ['title' => '', 'points_text' => ''];
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
        $this->itinerary = empty($result) ? null : json_encode($result);
    }

    /**
     * Remove selected image before submission
     */
    public function removeImage($index)
    {
        if (!isset($this->images[$index])) return;
        array_splice($this->images, $index, 1);
    }

    public function store()
    {
        $this->validate();

        $this->prepareItinerary();

        $slug = $this->slug ? $this->slug : Str::slug($this->title);

        $package = TourPackage::create([
            'title' => $this->title,
            'slug' => $slug,
            'meta_title' => $this->meta_title,
            'meta_description' => $this->meta_description,
            'meta_keywords' => $this->meta_keywords,
            'itinerary' => $this->itinerary,
            'description' => $this->description,
            'price' => $this->price,
            'includes' => empty($this->includes) ? null : json_encode(array_values(array_filter($this->includes, fn($v) => trim($v) !== ''))),
            'optional' => empty($this->optional) ? null : json_encode(array_values(array_filter($this->optional, fn($v) => trim($v) !== ''))),
            'is_featured' => (bool)$this->is_featured,
        ]);

        // Handle featured image (if provided)
        if ($package && $this->featuredImage) {
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
            }
        }
        if ($package) {
            if (!empty($this->category_ids)) {
                $package->categories()->sync($this->category_ids);
            }
            if (!empty($this->destination_ids)) {
                $package->destinations()->sync($this->destination_ids);
            }
            if (!empty($this->experience_ids)) {
                $package->experiences()->sync($this->experience_ids);
            }

            // Handle images
            if (!empty($this->images) && is_array($this->images)) {
                $useImageKit = env('IMAGEKIT_PRIVATE_KEY') && env('IMAGEKIT_URL_ENDPOINT');
                foreach ($this->images as $i => $img) {
                    try {
                        if ($useImageKit) {
                            // ImageKitService::uploadToFolder($localPath, $originalName, $folder)
                            $ik = new ImageKitService();
                            $upload = $ik->uploadToFolder($img->getRealPath(), $img->getClientOriginalName(), '/tour_packages');
                            $data = is_array($upload) ? $upload : json_decode(json_encode($upload), true);
                            $url = $data['result']['url'] ?? $data['result']['filePath'] ?? null;
                            $fileId = $data['result']['fileId'] ?? null;

                            // create gallery
                            TourPackageGallery::create([
                                'tour_package_id' => $package->id,
                                'image_url' => $url,
                                'storage_path' => null,
                                'imagekit_file_id' => $fileId,
                            ]);

                            // set featured_image from first uploaded image (if not set)
                            if ($i === 0) {
                                $package->update([
                                    'featured_image' => $url,
                                    'imagekit_file_id' => $fileId,
                                    'storage_path' => null,
                                ]);
                            }

                            continue; // next image
                        }
                    } catch (\Exception $e) {
                        // fallback to local storage
                    }

                    // Local storage fallback
                    $path = $img->store('tour_packages', 'public'); // storage/app/public/tour_packages/...
                    $url = Storage::url($path); // /storage/tour_packages/...
                    TourPackageGallery::create([
                        'tour_package_id' => $package->id,
                        'image_url' => $url,
                        'storage_path' => $path,
                    ]);

                    if ($i === 0) {
                        $package->update([
                            'featured_image' => $url,
                            'storage_path' => $path,
                        ]);
                    }
                }
            }
        }

       $this->dispatch('success', 'Tour package created.');
        return redirect()->route('admin.tour.package.list');
    }

    #[Layout('components.layouts.admin')]
    #[Title('Add Tour Package')]
    public function render()
    {
        $allCategories = Category::all();
        $allDestinations = Destination::all();

        $allExperiences = Experience::all();
        return view('livewire.admin.tour.add-tour-package', compact('allCategories', 'allDestinations', 'allExperiences'));
    }
}
