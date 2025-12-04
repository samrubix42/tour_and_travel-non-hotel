<?php

namespace App\Livewire\Public\Tour;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\TourPackage;
use App\Models\Destination;
use App\Models\Experience;
use Livewire\Attributes\Title;
use App\Models\Page;

class Tour extends Component
{
    use WithPagination;

    public $perPage = 9;
    #[Title('Tour Packages - Explore Our Exciting Tours')]
    public function render()
    {
        $slug = request()->query('slug');
        $experienceSlug = request()->query('experience');

        $query = TourPackage::query()
            ->select('id', 'title', 'slug', 'description', 'price', 'featured_image')
            ->where('status', 1);
        $metaContent = null;
        if (!empty($experienceSlug)) {
            $experience = Experience::where('slug', $experienceSlug)->first();
            $metaContent = $experience;
            if ($experience) {
                $query->whereHas('experiences', function ($q) use ($experienceSlug) {
                    $q->where('slug', $experienceSlug);
                });
            }
        } elseif (!empty($slug)) {
            $destination = Destination::where('slug', $slug)->first();
            $metaContent = $destination;

            if ($destination) {
                $query->whereHas('destinations', function ($q) use ($slug) {
                    $q->where('slug', $slug);
                });
            }
        } else {
            $metaContent = Page::where('slug', 'tours')->first() ?? (object)[
                'meta_title' => 'Explore Our Exciting Tour Packages',
                'meta_description' => 'Discover a variety of tour packages tailored to your preferences. From adventure trips to relaxing getaways, find the perfect tour for you.',
                'meta_keywords' => 'tour packages, travel tours, vacation packages, adventure tours, holiday trips'
            ];
        }


        $tourPackages = $query->latest()->paginate($this->perPage);

        return view('livewire.public.tour.tour', compact('tourPackages', 'metaContent'));
    }
}
