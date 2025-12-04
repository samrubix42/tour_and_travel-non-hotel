<?php

namespace App\Livewire\Admin\PageManagement;

use Livewire\Component;
use App\Models\Page;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

class AddPageContent extends Component
{
    public $page_title = '';
    public $slug = '';
    public $page_content = '';
    public $meta_title = '';
    public $meta_description = '';
    public $meta_keywords = '';
    public $showModal = true;

    public function mount()
    {
        // when used as a standalone page, ensure content is visible
        $this->showModal = true;
    }

    protected $rules = [
        'page_title' => 'required|string',
        'slug' => 'required|string|unique:pages,slug',
        'page_content' => 'required',
        'meta_title' => 'nullable|string',
        'meta_description' => 'nullable|string',
        'meta_keywords' => 'nullable|string',
    ];

    protected $listeners = [
        'openModal' => 'openModal',
    ];

    public function openModal()
    {
        $this->resetFields();
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }

    public function resetFields()
    {
        $this->page_title = '';
        $this->slug = '';
        $this->page_content = '';
        $this->meta_title = '';
        $this->meta_description = '';
        $this->meta_keywords = '';
    }

    public function savePage()
    {
        $data = $this->validate();
        Page::create($data);
        $this->dispatch('sucess', 'Page created successfully.');
        $this->dispatch('pageListUpdated');
        return redirect()->route('admin.page.management');
    }

    #[Layout('components.layouts.admin')]
    #[Title('Add Page')]
    public function render()
    {
        return view('livewire.admin.page-management.add-page-content');
    }
}
