<?php

namespace App\Livewire\Admin\PageManagement;

use Livewire\Component;
use App\Models\Page;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

class UpdatePageContent extends Component
{
    public $pageId;
    public $page_title = '';
    public $slug = '';
    public $page_content = '';
    public $meta_title = '';
    public $meta_description = '';
    public $meta_keywords = '';
    public $showModal = true;

    public function mount($id = null)
    {
        if ($id) {
            $this->openModal($id);
        }
        $this->showModal = true;
    }

    protected $rules = [
        'page_title' => 'required|string',
        'slug' => 'required|string',
        'page_content' => 'required',
        'meta_title' => 'nullable|string',
        'meta_description' => 'nullable|string',
        'meta_keywords' => 'nullable|string',
    ];

    public function rules()
    {
        $uniqueSlug = 'unique:pages,slug';
        if ($this->pageId) {
            $uniqueSlug = 'unique:pages,slug,' . $this->pageId;
        }

        return [
            'page_title' => 'required|string',
            'slug' => ['required','string', $uniqueSlug],
            'page_content' => 'required',
            'meta_title' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
        ];
    }

    protected $listeners = [
        'openModal' => 'openModal',
    ];

    public function openModal($id = null)
    {
        if ($id) {
            $page = Page::findOrFail($id);
            $this->pageId = $id;
            $this->page_title = $page->page_title;
            $this->slug = $page->slug;
            $this->page_content = $page->page_content;
            $this->meta_title = $page->meta_title;
            $this->meta_description = $page->meta_description;
            $this->meta_keywords = $page->meta_keywords;
        }
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }

    public function savePage()
    {
        $data = $this->validate();
        if ($this->pageId) {
            $page = Page::findOrFail($this->pageId);
            $page->update($data);
        }
        $this->dispatch('sucess', 'Page updated successfully.');
        $this->dispatch('pageListUpdated');
        return redirect()->route('admin.page.management');
    }

    #[Layout('components.layouts.admin')]
    #[Title('Update Page')]
    public function render()
    {
        return view('livewire.admin.page-management.update-page-content');
    }
}

