<?php

namespace App\Livewire\Public\Blog;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\WithPagination;
use App\Models\Post;
use App\Models\Page;

class Blog extends Component
{
    use WithPagination;

    public $tag = '';

    protected $queryString = [
        'tag' => ['except' => ''],
    ];

    #[Title('Blog - Latest Posts')]
    public function render()
    {
        $query = Post::with('category')->latest();

        if (!empty($this->tag)) {
            $tag = strtolower($this->tag);
            $query->whereRaw('LOWER(tags) LIKE ?', ["%{$tag}%"]);
        }

        $posts = $query->paginate(9);

        $page = Page::where('slug', 'blog')->first();

        return view('livewire.public.blog.blog', compact('posts', 'page'));
    }
}
