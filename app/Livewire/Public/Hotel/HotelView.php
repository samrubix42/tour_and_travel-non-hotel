<?php

namespace App\Livewire\Public\Hotel;

use Livewire\Component;
use App\Models\Hotel;

class HotelView extends Component
{
    public $slug;
    public $hotel;

    public function mount($slug)
    {
        $this->slug = $slug;
        $this->hotel = Hotel::with('galleries')->where('slug', $slug)->firstOrFail();
    }
    public function render()
    {
        $meta_title = $this->hotel->meta_title ?? $this->hotel->name;
        $meta_description = $this->hotel->meta_description ?? null;
        $meta_keywords = $this->hotel->meta_keywords ?? null;

        return view('livewire.public.hotel.hotel-view', [
            'hotel' => $this->hotel,
            'title' => $meta_title,
            'meta_title' => $meta_title,
            'meta_description' => $meta_description,
            'meta_keywords' => $meta_keywords,
        ]);
    }
}
