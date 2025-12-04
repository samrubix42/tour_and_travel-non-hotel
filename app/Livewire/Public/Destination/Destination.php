<?php

namespace App\Livewire\Public\Destination;

use Livewire\Component;
use Livewire\Attributes\Title;
use App\Models\Destination as DestinationModel;
use App\Models\Page;

class Destination extends Component
{
    #[Title('Destinations - Explore Destinations')]
    public function render()
    {
        $destinations = DestinationModel::where('status', true)
            ->orderBy('name')
            ->get();

        $page = Page::where('slug', 'destinations')->first();

        return view('livewire.public.destination.destination', [
            'destinations' => $destinations,
            'page' => $page,
        ]);
    }
}
