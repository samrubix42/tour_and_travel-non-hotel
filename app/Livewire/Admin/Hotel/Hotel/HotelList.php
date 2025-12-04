<?php

namespace App\Livewire\Admin\Hotel\Hotel;

use App\Models\Hotel;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;


class HotelList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $perPage = 10;
    public $confirmingDeleteId = null;

    protected $queryString = ['search', 'perPage'];

    #[Layout('components.layouts.admin')]
    #[Title('Hotels')]
    public function render()
    {
        $query = Hotel::with(['category', 'destination'])->orderBy('created_at', 'desc');

        if (!empty($this->search)) {
            $query->where(function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('address', 'like', '%' . $this->search . '%');
            });
        }

        $hotels = $query->paginate($this->perPage);

        return view('livewire.admin.hotel.hotel.hotel-list', compact('hotels'));
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingPerPage()
    {
        $this->resetPage();
    }

    public function confirmDelete($id)
    {
        $this->confirmingDeleteId = $id;
        $this->dispatch('openDeleteModal');
    }

    public function deleteHotel()
    {
        if (!$this->confirmingDeleteId) return;

        $hotel = Hotel::find($this->confirmingDeleteId);
        if ($hotel) {
            $hotel->delete();
        }

        $this->confirmingDeleteId = null;
        $this->dispatch('closeDeleteModal');
       $this->dispatch('success', 'Hotel deleted successfully.');
    }

    public function openHotel($id)
    {
        $this->dispatch('openHotel', $id);
    }
}
