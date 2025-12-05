<?php

namespace App\Livewire\Admin\Contact;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Contact;
use Livewire\Attributes\Layout;

class ContactList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $perPage = 10;
    public $selectedContactId = null;
    public $confirmingDelete = null;
    public $sortField = 'created_at';
    public $sortDirection = 'desc';
    
    #[Layout('components.layouts.admin')]
    public function render()
    {
        $contacts = Contact::query()
            ->when($this->search, function ($q) {
                $term = '%' . $this->search . '%';
                $q->where(function ($q2) use ($term) {
                    $q2->where('name', 'like', $term)
                        ->orWhere('email', 'like', $term)
                        ->orWhere('phone', 'like', $term)
                        ->orWhere('message', 'like', $term);
                });
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);

        // expose the computed selectedContact to the view to avoid undefined variable errors
        $selectedContact = $this->selectedContact;
        return view('livewire.admin.contact.contact-list', compact('contacts', 'selectedContact'));
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function view($id)
    {
        $contact = Contact::find($id);
        if (!$contact) {
            return;
        }
        if (!$contact->is_read) {
            $contact->is_read = 1;
            $contact->save();
        }
        $this->selectedContactId = $id;
    }

    public function closeView()
    {
        $this->selectedContactId = null;
    }

    public function getSelectedContactProperty()
    {
        if (!$this->selectedContactId) {
            return null;
        }
        return Contact::find($this->selectedContactId);
    }

    public function confirmDelete($id)
    {
        $this->confirmingDelete = $id;
    }

    public function cancelDelete()
    {
        $this->confirmingDelete = null;
    }

    public function deleteConfirmed()
    {
        if (!$this->confirmingDelete) {
            return;
        }
        $contact = Contact::find($this->confirmingDelete);
        if ($contact) {
            $contact->delete();
        }
        if ($this->selectedContactId && $this->selectedContactId == $this->confirmingDelete) {
            $this->selectedContactId = null;
        }
        $this->confirmingDelete = null;
        $this->resetPage();
    }

    public function toggleRead($id)
    {
        $contact = Contact::find($id);
        if (!$contact) {
            return;
        }
        $contact->is_read = !$contact->is_read;
        $contact->save();
    }

    public function deleteContact($id)
    {
        $contact = Contact::find($id);
        if ($contact) {
            $contact->delete();
            $this->dispatch('success', 'Contact deleted successfully.');
        }
    }
}
