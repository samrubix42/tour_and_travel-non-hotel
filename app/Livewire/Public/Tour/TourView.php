<?php

namespace App\Livewire\Public\Tour;

use Livewire\Component;
use App\Models\TourPackage;

class TourView extends Component
{
    public $package;

    public function mount($slug)
    {
        $this->package = TourPackage::with(['destinations', 'experiences', 'galleries'])
            ->where('slug', $slug)
            ->where('status', 1)
            ->first();

        if (! $this->package) {
            abort(404);
        }
    }
    public function render()
    {
        $meta_title = $this->package->meta_title ?? $this->package->title;
        $meta_description = $this->package->meta_description ?? null;
        $meta_keywords = $this->package->meta_keywords ?? null;

        return view('livewire.public.tour.tour-view', [
            'package' => $this->package,
            'title' => $meta_title,
            'meta_title' => $meta_title,
            'meta_description' => $meta_description,
            'meta_keywords' => $meta_keywords,
        ]);
    }
}
