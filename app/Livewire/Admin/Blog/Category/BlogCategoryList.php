<?php

namespace App\Livewire\Admin\Blog\Category;


use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\BlogCategory;
use Illuminate\Support\Str;

class BlogCategoryList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $perPage = 10;
    public $showModal = false;
    public $showDeleteModal = false;

    public $categoryId;
    public $name;
    public $slug;
    public $status = true;

    protected function rules()
    {
        $uniqueRule = $this->categoryId ? "unique:blog_categories,slug,{$this->categoryId}" : 'unique:blog_categories,slug';
        return [
            'name' => 'required|string|max:255',
            'slug' => ['required', 'string', 'max:255', $uniqueRule],
            'status' => 'boolean',
        ];
    }

    public function updatedName()
    {
        $this->slug = Str::slug($this->name);
    }

    #[Layout('components.layouts.admin')]
    #[Title('Blog Categories')]
    public function render()
    {
        $query = BlogCategory::query();
        if ($this->search) {
            $query->where('name', 'like', "%{$this->search}%")
                  ->orWhere('slug', 'like', "%{$this->search}%");
        }
        $categories = $query->orderBy('created_at', 'desc')->paginate($this->perPage);
        return view('livewire.admin.blog.category.blog-category-list', [
            'categories' => $categories,
        ]);
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function create()
    {
        $this->resetForm();
        $this->showModal = true;
    }

    public function edit($id)
    {
        $cat = BlogCategory::findOrFail($id);
        $this->categoryId = $cat->id;
        $this->name = $cat->name;
        $this->slug = $cat->slug;
        $this->status = (bool) $cat->status;
        $this->showModal = true;
    }

    public function save()
    {
        $this->validate();
        $data = [
            'name' => $this->name,
            'slug' => $this->slug,
            'status' => $this->status,
        ];
        if ($this->categoryId) {
            BlogCategory::findOrFail($this->categoryId)->update($data);
           $this->dispatch('success', 'Blog category updated successfully.');
        } else {
            BlogCategory::create($data);
           $this->dispatch('success', 'Blog category created successfully.');
        }
        $this->closeModal();
        $this->resetPage();
    }

    public function confirmDelete($id)
    {
        $this->categoryId = $id;
        $this->showDeleteModal = true;
    }

    public function delete()
    {
        if ($this->categoryId) {
            BlogCategory::destroy($this->categoryId);
           $this->dispatch('success', 'Blog category deleted.');
        }
        $this->showDeleteModal = false;
        $this->resetPage();
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->resetForm();
    }

    public function cancelDelete()
    {
        $this->showDeleteModal = false;
        $this->categoryId = null;
    }

    protected function resetForm()
    {
        $this->categoryId = null;
        $this->name = null;
        $this->slug = null;
        $this->status = true;
        $this->resetValidation();
    }
}
