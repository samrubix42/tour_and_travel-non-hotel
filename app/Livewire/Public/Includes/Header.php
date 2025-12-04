<?php

namespace App\Livewire\Public\Includes;

use Livewire\Component;
use App\Models\Destination;
use App\Models\Experience;
use Livewire\Attributes\Computed;

class Header extends Component
{
    public $destinations;
    public $experiences;
    
    #[Computed]
    public function mount()
    {
        $this->destinations = Destination::where('status', 1)->orderBy('name')->get();
        $this->experiences = Experience::where('status', 1)->orderBy('name')->get();
    }
    public function render()
    {

        return view('livewire.public.includes.header');
    }
}
