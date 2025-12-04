<?php

namespace App\Livewire\Admin\Blog\Post;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Post;
use App\Models\BlogCategory;
use Illuminate\Support\Facades\Storage;
use App\Services\ImageKitService;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

class UpdatePost extends Component
{
    use WithFileUploads;

    public $postId;
    public $category_id;
    public $meta_title;
    public $meta_description;
    public $meta_keywords;
    public $featured_image; // new upload
    public $thumbnail_image; // new upload
    public $currentFeaturedUrl;
    public $currentThumbnailUrl;
    public $title;
    public $slug;
    public $main_content;
    public $tags;

    public function mount($id)
    {
        $post = Post::findOrFail($id);
        $this->postId = $post->id;
        $this->category_id = $post->category_id;
        $this->meta_title = $post->meta_title;
        $this->meta_description = $post->meta_description;
        $this->meta_keywords = $post->meta_keywords;
        $this->currentFeaturedUrl = $post->featured_image;
        $this->currentThumbnailUrl = $post->thumbnail_image;
        $this->title = $post->title;
        $this->slug = $post->slug;
        $this->main_content = $post->main_content;
        $this->tags = $post->tags;
    }

    #[Layout('components.layouts.admin')]
    #[Title('Update Post')]
    public function render()
    {
        $categories = BlogCategory::where('status',1)->get();
        return view('livewire.admin.blog.post.update-post', compact('categories'));
    }

    protected function rules()
    {
        return [
            'category_id' => 'required|exists:blog_categories,id',
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:posts,slug,' . $this->postId,
            'main_content' => 'required',
            'tags' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string|max:255',
            'featured_image' => 'nullable|image|max:5120',
            'thumbnail_image' => 'nullable|image|max:5120',
        ];
    }

    public function update()
    {
        $this->validate();

        $post = Post::findOrFail($this->postId);

        $post->category_id = $this->category_id;
        $post->meta_title = $this->meta_title;
        $post->meta_description = $this->meta_description;
        $post->meta_keywords = $this->meta_keywords;
        $post->title = $this->title;
        $post->slug = $this->slug;
        $post->main_content = $this->main_content;
        $post->tags = $this->tags;

        $useImageKit = env('IMAGEKIT_PUBLIC_KEY') && env('IMAGEKIT_PRIVATE_KEY') && env('IMAGEKIT_URL_ENDPOINT');
        if ($useImageKit) {
            $ik = app(ImageKitService::class);
        }

        if ($this->featured_image) {
            // delete previous
            if ($post->featured_image_kit_file_id) {
                try { if ($useImageKit) { $ik->deleteFile($post->featured_image_kit_file_id); } } catch (\Exception $e) {}
            }
            if ($post->featured_storage_path) {
                try { Storage::disk('public')->delete($post->featured_storage_path); } catch (\Exception $e) {}
            }

            $localPath = $this->featured_image->store('posts', 'public');
            $post->featured_storage_path = $localPath;
            $post->featured_image = asset(Storage::url($localPath));
            try {
                if ($useImageKit) {
                    $tmp = storage_path('app/public/' . $localPath);
                    $res = $ik->uploadToFolder($tmp, basename($tmp), '/posts');
                    if (!empty($res->result->url)) {
                        $post->featured_image = $res->result->url;
                        $post->featured_image_kit_file_id = $res->result->fileId ?? null;
                    }
                }
            } catch (\Exception $e) { }
        }

        if ($this->thumbnail_image) {
            if ($post->thumbnail_image_kit_file_id) {
                try { if ($useImageKit) { $ik->deleteFile($post->thumbnail_image_kit_file_id); } } catch (\Exception $e) {}
            }
            if ($post->thumbnail_storage_path) {
                try { Storage::disk('public')->delete($post->thumbnail_storage_path); } catch (\Exception $e) {}
            }

            $localPath = $this->thumbnail_image->store('posts', 'public');
            $post->thumbnail_storage_path = $localPath;
            $post->thumbnail_image = asset(Storage::url($localPath));
            try {
                if ($useImageKit) {
                    $tmp = storage_path('app/public/' . $localPath);
                    $res = $ik->uploadToFolder($tmp, basename($tmp), '/posts');
                    if (!empty($res->result->url)) {
                        $post->thumbnail_image = $res->result->url;
                        $post->thumbnail_image_kit_file_id = $res->result->fileId ?? null;
                    }
                }
            } catch (\Exception $e) { }
        }

        $post->save();

        $this->dispatch('sucess', 'Post updated successfully.');
        return redirect()->route('admin.blog.post.list');
    }
}
