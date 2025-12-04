<?php

namespace App\Livewire\Admin\PageManagement;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Page;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

class PageList extends Component
{
    use WithPagination;

    public $search = '';
    public $confirmingDelete = false;
    public $deleteId = null;

    protected $listeners = [
        'pageListUpdated' => '$refresh',
    ];

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function confirmDelete($id)
    {
        $this->deleteId = $id;
        $this->confirmingDelete = true;
    }

    public function cancelDelete()
    {
        $this->deleteId = null;
        $this->confirmingDelete = false;
    }

    public function performDelete()
    {
        if ($this->deleteId) {
            Page::findOrFail($this->deleteId)->delete();
            $this->deleteId = null;
            $this->confirmingDelete = false;
            $this->emit('pageListUpdated');
            $this->dispatch('sucess', 'Page deleted successfully.');
        }
    }

    #[Layout('components.layouts.admin')]
    #[Title('Pages')]
    public function render()
    {
        $pages = Page::where('page_title', 'like', '%' . $this->search . '%')
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('livewire.admin.page-management.page-list', compact('pages'));
    }
}
