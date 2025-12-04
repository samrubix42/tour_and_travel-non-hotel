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

class AddPost extends Component
{
    use WithFileUploads;

    public $category_id;
    public $meta_title;
    public $meta_description;
    public $meta_keywords;
    public $featured_image; // uploaded file
    public $thumbnail_image; // uploaded file
    public $title;
    public $slug;
    public $main_content;
    public $tags;

    #[Layout('components.layouts.admin')]
    #[Title('Add Post')]
    public function render()
    {
        $categories = BlogCategory::where('status', 1)->get();
        return view('livewire.admin.blog.post.add-post', compact('categories'));
    }
    public function updatedTitle()
    {
        $this->slug = \Illuminate\Support\Str::slug($this->title);
    }

    protected function rules()
    {
        return [
            'category_id' => 'required|exists:blog_categories,id',
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:posts,slug',
            'main_content' => 'required',
            'tags' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string|max:255',
            'featured_image' => 'nullable|image|max:5120',
            'thumbnail_image' => 'nullable|image|max:5120',
        ];
    }

    public function save()
    {
        $this->validate();

        $data = [
            'category_id' => $this->category_id,
            'meta_title' => $this->meta_title,
            'meta_description' => $this->meta_description,
            'meta_keywords' => $this->meta_keywords,
            'title' => $this->title,
            'slug' => $this->slug,
            'main_content' => $this->main_content,
            'tags' => $this->tags,
        ];

        // handle images
        $useImageKit = env('IMAGEKIT_PUBLIC_KEY') && env('IMAGEKIT_PRIVATE_KEY') && env('IMAGEKIT_URL_ENDPOINT');

        if ($this->featured_image) {
            $localPath = $this->featured_image->store('posts', 'public');
            $data['featured_storage_path'] = $localPath;
            $data['featured_image'] = asset(Storage::url($localPath));
            // try imagekit if enabled
            try {
                if ($useImageKit) {
                    $ik = app(ImageKitService::class);
                    $tmp = storage_path('app/public/' . $localPath);
                    $res = $ik->uploadToFolder($tmp, basename($tmp), '/posts');
                    if (!empty($res->result->url)) {
                        $data['featured_image'] = $res->result->url;
                        $data['featured_image_kit_file_id'] = $res->result->fileId ?? null;
                    }
                }
            } catch (\Exception $e) { }
        }

        if ($this->thumbnail_image) {
            $localPath = $this->thumbnail_image->store('posts', 'public');
            $data['thumbnail_storage_path'] = $localPath;
            $data['thumbnail_image'] = asset(Storage::url($localPath));
            try {
                if ($useImageKit) {
                    $ik = app(ImageKitService::class);
                    $tmp = storage_path('app/public/' . $localPath);
                    $res = $ik->uploadToFolder($tmp, basename($tmp), '/posts');
                    if (!empty($res->result->url)) {
                        $data['thumbnail_image'] = $res->result->url;
                        $data['thumbnail_image_kit_file_id'] = $res->result->fileId ?? null;
                    }
                }
            } catch (\Exception $e) { }
        }

        Post::create($data);

        $this->dispatch('sucess', 'Post created successfully.');
        return redirect()->route('admin.blog.post.list');
    }
}
