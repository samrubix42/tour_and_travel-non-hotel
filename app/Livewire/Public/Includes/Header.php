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

        $this->yatraDestinations = Destination::where('status', 1)
            ->whereHas('categories', function ($q) {
                $q->where('slug', 'yatra')
                    ->orWhereRaw('LOWER(name) LIKE ?', ['%yatra%']);
            })
            ->orderBy('name')
            ->get();
    }
    public function render()
    {

        return view('livewire.public.includes.header');
    }
}
