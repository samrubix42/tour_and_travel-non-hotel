<?php

namespace App\Livewire\Public;

use Livewire\Component;
use Livewire\Attributes\Title;
use App\Models\Page;

class About extends Component
{
    #[Title('About Us')]
    public function render()
    {
        $page = Page::where('slug', 'about')->first();
        return view('livewire.public.about', compact('page'));
    }
}
