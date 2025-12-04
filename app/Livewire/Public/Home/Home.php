<?php

namespace App\Livewire\Public\Home;

use Livewire\Component;
use Livewire\Attributes\Title;
use App\Models\Page;
use App\Models\Experience;

class Home extends Component
{
    #[Title('Home - Explore Tours & Hotels')]
    public function render()
    {
        $categories = \App\Models\Category::with(['destinations' => function($q) {
            $q->where('status', true);
        }])->where('status', true)->get();

        $banners = \App\Models\Banner::where('status', true)->get();

        // prepare featured packages per category to avoid querying in the view
        $categoryPackages = [];
        foreach ($categories as $category) {
            $categoryPackages[$category->id] = \App\Models\TourPackage::whereHas('categories', function($q) use ($category) {
                $q->where('categories.id', $category->id);
            })->where('is_featured', true)->get();
        }

        // prepare featured destinations to render in the home slider
        $featuredDestinations = \App\Models\Destination::where('status', true)
            ->where('is_featured', true)
            ->get();

        // latest blog posts
        $latestPosts = \App\Models\Post::whereNotNull('created_at')
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        $page = Page::where('slug', 'home')->first();

        $experiences = Experience::where('status', true)->orderBy('name')->get();

        return view('livewire.public.home.home', [
            'categories' => $categories,
            'banners' => $banners,
            'categoryPackages' => $categoryPackages,
            'featuredDestinations' => $featuredDestinations,
            'latestPosts' => $latestPosts,
            'page' => $page,
            'experiences' => $experiences,
        ]);
    }
}
