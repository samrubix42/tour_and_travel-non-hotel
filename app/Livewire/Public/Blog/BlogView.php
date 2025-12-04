<?php

namespace App\Livewire\Public\Blog;

use Livewire\Component;
use App\Models\Post;

use Illuminate\Support\Str;

class BlogView extends Component
{
    public $post;
    public $relatedPosts = [];

    public function mount($slug)
    {
        $post = Post::with('category')->where('slug', $slug)->firstOrFail();
        $this->post = $post;

        $this->relatedPosts = Post::where('category_id', $post->category_id)
            ->where('id', '<>', $post->id)
            ->latest()
            ->take(3)
            ->get();
    }

    public function render()
    {
        $meta_title = $this->post->meta_title ?? $this->post->title;
        $meta_description = $this->post->meta_description ?? null;
        $meta_keywords = $this->post->meta_keywords ?? null;

        return view('livewire.public.blog.blog-view', [
            'post' => $this->post,
            'relatedPosts' => $this->relatedPosts,
            'title' => $meta_title,
            'meta_title' => $meta_title,
            'meta_description' => $meta_description,
            'meta_keywords' => $meta_keywords,
        ]);
    }
}
