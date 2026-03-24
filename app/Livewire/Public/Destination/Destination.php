<?php

namespace App\Livewire\Public\Destination;

use Livewire\Component;
use Livewire\Attributes\Title;
use App\Models\Destination as DestinationModel;
use App\Models\Page;

class Destination extends Component
{
    public $categorySlug = 'all';

    protected $queryString = [
        'categorySlug' => ['except' => 'all'],
    ];

    public function mount()
    {
        // $this->categorySlug is automatically set via queryString if present
    }

    #[Title('Destinations - Explore Destinations')]
    public function setFilter($slug)
    {
        $this->categorySlug = $slug;
    }

    public function render()
    {
        $query = DestinationModel::where('status', true);

        if ($this->categorySlug && $this->categorySlug !== 'all') {
            $query->whereHas('categories', function ($q) {
                $q->where('slug', $this->categorySlug);
            });
        }

        $destinations = $query->orderBy('name')->get();

        $page = Page::where('slug', 'destinations')->first();

        // Get all categories to show in filter
        $categories = \App\Models\Category::where('status', true)->get();

        return view('livewire.public.destination.destination', [
            'destinations' => $destinations,
            'page' => $page,
            'categories' => $categories,
        ]);
    }
}
