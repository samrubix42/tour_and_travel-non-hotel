<?php

namespace App\Livewire\Admin\Enquires;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\ContactForTour;
use App\Models\Destination;

class Tour extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $perPage = 12;
    public $selectedContact = null;
    public $showModal = false;
    public $confirmDeleteId = null;
    public $showDeleteConfirm = false;

    #[Layout('components.layouts.admin')]
    #[Title('Tour Enquiries')]
    public function render()
    {
        $query = ContactForTour::query()->orderBy('created_at', 'desc');

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('name', 'like', "%{$this->search}%")
                  ->orWhere('email', 'like', "%{$this->search}%")
                  ->orWhere('phone', 'like', "%{$this->search}%");
            });
        }

        $contacts = $query->paginate($this->perPage);

        return view('livewire.admin.enquires.tour', compact('contacts'));
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function viewContact($id)
    {
        $this->selectedContact = ContactForTour::find($id);
        if ($this->selectedContact && $this->selectedContact->destination_id) {
            $dest = Destination::find($this->selectedContact->destination_id);
            $this->selectedContact->destination_name = $dest->name ?? null;
        }
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->selectedContact = null;
    }

    public function confirmDelete($id)
    {
        $this->confirmDeleteId = $id;
        $this->showDeleteConfirm = true;
    }

    public function deleteConfirmed()
    {
        if ($this->confirmDeleteId) {
            $c = ContactForTour::find($this->confirmDeleteId);
            if ($c) {
                $c->delete();
            }
        }

        $this->showDeleteConfirm = false;
        $this->confirmDeleteId = null;
        $this->resetPage();
        $this->dispatch('success', 'Deleted');}

    public function toggleStatus($id)
    {
        $c = ContactForTour::find($id);
        if (! $c) {
            return;
        }

        if (is_null($c->status) || $c->status === '') {
            $c->status = 'handled';
        } elseif (is_numeric($c->status) || is_bool($c->status)) {
            $c->status = $c->status ? 0 : 1;
        } else {
            $c->status = ($c->status === 'handled') ? 'pending' : 'handled';
        }

        $c->save();
        $this->dispatch('success', 'Status updated');
    }
}
