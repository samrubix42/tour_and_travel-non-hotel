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

    #[Computed]
    public function mount()
    {
        $this->destinations = Destination::where('status', 1)->orderBy('name')->get();
        $this->experiences = Experience::where('status', 1)->orderBy('name')->get();
        $this->religPackages = TourPackage::whereHas('categories', function ($q) {
            $q->where('slug', 'religious')
                ->orWhere('slug', 'religous')
                ->orWhereRaw('LOWER(name) LIKE ?', ['%relig%']);
        })->where('status', true)->take(8)->get();
        $this->internationalPackages = TourPackage::whereHas('categories', function ($q) {
            $q->where('slug', 'international')
                ->orWhereRaw('LOWER(name) LIKE ?', ['%international%']);
        })->where('status', true)->take(8)->get();
    }
    public function render()
    {

        return view('livewire.public.includes.header');
    }
}
