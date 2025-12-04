<?php

namespace App\Livewire\Public\Experience;

use Livewire\Component;
use Livewire\Attributes\Title;
use App\Models\Experience as ExperienceModel;
use App\Models\Page;

class Experience extends Component
{
    #[Title('Experiences - Browse Experiences')]
    public function render()
    {
        $experiences = ExperienceModel::where('status', true)
            ->orderBy('name')
            ->get();

        $page = Page::where('slug', 'experiences')->first();

        return view('livewire.public.experience.experience', [
            'experiences' => $experiences,
            'page' => $page,
        ]);
    }
}
