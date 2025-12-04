<?php

namespace App\Livewire\Admin\Tour;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\TourPackage;

class TourPackageList extends Component
{
    use WithPagination;
    
    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $perPage = 10;
    public $filter_status = 'all';
    public $filter_featured = 'all';

    protected $queryString = [];

    public function delete($id)
    {
        $package = TourPackage::find($id);
        if ($package) {
            $package->delete();
           $this->dispatch('success', 'Tour package deleted.');
        }
    }

    #[Layout('components.layouts.admin')]
    #[Title('Tour Packages')]
    public function render()
    {
        $query = TourPackage::query();
        if ($this->search) {
            $query->where('title', 'like', '%'.$this->search.'%')
                  ->orWhere('slug', 'like', '%'.$this->search.'%');
        }

        if ($this->filter_status !== 'all') {
            if ($this->filter_status === 'active') {
                $query->where('status', 1);
            } elseif ($this->filter_status === 'hidden') {
                $query->where('status', 0);
            }
        }

        if ($this->filter_featured !== 'all') {
            if ($this->filter_featured === 'featured') {
                $query->where('is_featured', 1);
            } elseif ($this->filter_featured === 'not_featured') {
                $query->where('is_featured', 0);
            }
        }

        $packages = $query->orderBy('id', 'desc')->paginate($this->perPage);

        return view('livewire.admin.tour.tour-package-list', compact('packages'));
    }
}
