<?php

namespace App\Livewire\Admin\Blog\Post;

use App\Models\Post;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;
use App\Services\ImageKitService;
use Illuminate\Support\Facades\Storage;

class PostList extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $perPage = 10;

    #[Layout('components.layouts.admin')]
    #[Title('Posts')]
    public function render()
    {
        $posts = Post::when($this->search, function ($q) {
            $q->where('title', 'like', '%' . $this->search . '%')
                ->orWhere('slug', 'like', '%' . $this->search . '%');
        })->orderByDesc('created_at')->paginate($this->perPage);

        return view('livewire.admin.blog.post.post-list', [
            'posts' => $posts,
        ]);
    }

    public function delete(Post $post)
    {
        // delete imagekit files if present
        $useImageKit = env('IMAGEKIT_PUBLIC_KEY') && env('IMAGEKIT_PRIVATE_KEY') && env('IMAGEKIT_URL_ENDPOINT');
        if ($useImageKit) {
            $ik = app(ImageKitService::class);
            if ($post->featured_image_kit_file_id) {
                try {
                    $ik->deleteFile($post->featured_image_kit_file_id);
                } catch (\Exception $e) {
                }
            }
            if ($post->thumbnail_image_kit_file_id) {
                try {
                    $ik->deleteFile($post->thumbnail_image_kit_file_id);
                } catch (\Exception $e) {
                }
            }
        }

        // delete local storage files
        if ($post->featured_storage_path) {
            try {
                Storage::disk('public')->delete($post->featured_storage_path);
            } catch (\Exception $e) {
            }
        }
        if ($post->thumbnail_storage_path) {
            try {
                Storage::disk('public')->delete($post->thumbnail_storage_path);
            } catch (\Exception $e) {
            }
        }

        $post->delete();

        $this->dispatch('sucess', 'Post deleted successfully.');
        $this->resetPage();
    }
}
