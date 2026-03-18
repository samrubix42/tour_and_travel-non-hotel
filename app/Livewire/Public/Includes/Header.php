<?php

namespace App\Livewire\Public\Includes;

use Livewire\Component;
use App\Models\Destination;
use App\Models\Experience;
use App\Models\TourPackage;
use Livewire\Attributes\Computed;

class Header extends Component
{
    public $destinations;
    public $experiences;
    public $religPackages;
    public $internationalPackages;
    public $yatraDestinations;
    public $showDestinationSearch = false;
    public $destinationSearch = '';
    public $destinationPackages = [];

    #[Computed]
    public function mount()
    {
        $this->destinations = Destination::where('status', 1)
            ->whereHas('categories', function ($q) {
                $q->where('slug', 'domestic');
            })
            ->orderBy('name')
            ->get();
        $this->experiences = Experience::where('status', 1)->orderBy('name')->get();
        $this->religPackages = TourPackage::whereHas('categories', function ($q) {
            $q->where('slug', 'religious')
                ->orWhere('slug', 'religous')
                ->orWhereRaw('LOWER(name) LIKE ?', ['%relig%']);
        })->where('status', true)->take(8)->get();
        $this->internationalPackages = Destination::where('status', 1)
            ->whereHas('categories', function ($q) {
                $q->where('slug', 'international');
            })
            ->orderBy('name')
            ->get();

        $this->yatraDestinations = Destination::where('status', 1)
            ->whereHas('categories', function ($q) {
                $q->where('slug', 'yatra');
            })
            ->orderBy('name')
            ->get();
    }
    public function render()
    {

        return view('livewire.public.includes.header');
    }

    public function toggleDestinationSearch()
    {
        $this->showDestinationSearch = !$this->showDestinationSearch;

        if (!$this->showDestinationSearch) {
            $this->destinationSearch = '';
            $this->destinationPackages = [];
        }
    }

    public function updatedDestinationSearch($value)
    {
        $term = trim($value);

        if (strlen($term) < 2) {
            $this->destinationPackages = [];
            return;
        }

        $this->destinationPackages = TourPackage::where(function ($q) use ($term) {
                $q->where('title', 'like', '%' . $term . '%')
                    ->orWhereHas('destinations', function ($dq) use ($term) {
                        $dq->where('name', 'like', '%' . $term . '%')
                            ->orWhere('slug', 'like', '%' . $term . '%');
                    });
            })
            ->where('status', 1)
            ->with(['destinations:id,name'])
            ->orderBy('title')
            ->limit(10)
            ->get(['id', 'title', 'slug', 'featured_image', 'price']);
    }
}
