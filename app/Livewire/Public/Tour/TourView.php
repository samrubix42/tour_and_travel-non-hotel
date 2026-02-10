<?php

namespace App\Livewire\Public\Tour;

use Livewire\Component;
use App\Models\TourPackage;
use App\Models\Testimonial;

class TourView extends Component
{
    public $package;
    public $name;
    public $phone;
    public $email;
    public $message;
    public $tour_id;

    public function mount($slug)
    {
        $this->package = TourPackage::with(['destinations', 'experiences', 'galleries', 'sliderImages'])
            ->where('slug', $slug)
            ->where('status', 1)
            ->first();

        if (! $this->package) {
            abort(404);
        }
    }
    public function submit(){
        $this->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:50',
            'email' => 'nullable|email|max:255',
            'message' => 'nullable|string|max:2000',
        ]);
        $data = [
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
            'message' => $this->message,
            'tour_id' => $this->package->id,
            'ip' => request()->ip(),
            'status' => 'pending',
        ];
        \App\Models\ContactForTour::create($data);
        $this->reset(['name','phone','email','message']);
        session()->flash('message', 'Your enquiry has been submitted.');
    }
    public function render()
    {
        $meta_title = $this->package->meta_title ?? $this->package->title;
        $meta_description = $this->package->meta_description ?? null;
        $meta_keywords = $this->package->meta_keywords ?? null;

        $bannerImage = asset('asset/image/bsr-travel-hero.jpg');

        if (! empty($this->package->banner_image)) {
            $bannerImage = $this->package->banner_image;
        } elseif (! empty($this->package->featured_image)) {
            $bannerImage = $this->package->featured_image;
        } elseif ($this->package->galleries && $this->package->galleries->isNotEmpty()) {
            $firstGallery = $this->package->galleries->first();

            if (! empty($firstGallery->image_url)) {
                $bannerImage = $firstGallery->image_url;
            } elseif (! empty($firstGallery->storage_path)) {
                $bannerImage = asset($firstGallery->storage_path);
            }
        }

        $testimonials = Testimonial::orderBy('created_at', 'desc')
            ->take(6)
            ->get();

        return view('livewire.public.tour.tour-view', [
            'package' => $this->package,
            'title' => $meta_title,
            'meta_title' => $meta_title,
            'meta_description' => $meta_description,
            'meta_keywords' => $meta_keywords,
            'bannerImage' => $bannerImage,
            'testimonials' => $testimonials,
        ]);
    }
}
