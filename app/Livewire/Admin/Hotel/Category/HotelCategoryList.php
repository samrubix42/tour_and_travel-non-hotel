<?php

namespace App\Livewire\Admin\Hotel\Category;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\HotelCategory;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

class HotelCategoryList extends Component
{
     use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $perPage = 10;

    public $showModal = false;
    public $showDeleteModal = false;

    public $hotelCategoryId;
    public $name;
    public $slug;
    public $description;
    public $status = 1;

    protected function rules()
    {
        $uniqueRule = $this->hotelCategoryId ? "unique:hotel_categories,slug,{$this->hotelCategoryId}" : 'unique:hotel_categories,slug';
        return [
            'name' => 'required|string|max:255',
            'slug' => ['required','string','max:255',$uniqueRule],
            'description' => 'nullable|string',
            'status' => 'boolean',
        ];
    }

    #[Layout('components.layouts.admin')]
    #[Title('Hotel Categories')]
    public function render()
    {
        $query = HotelCategory::query();
        if ($this->search) {
            $query->where('name', 'like', "%{$this->search}%")
                  ->orWhere('slug', 'like', "%{$this->search}%");
        }

        $categories = $query->orderBy('created_at','desc')->paginate($this->perPage);

        return view('livewire.admin.hotel.category.hotel-category-list', [
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
        $c = HotelCategory::findOrFail($id);
        $this->hotelCategoryId = $c->id;
        $this->name = $c->name;
        $this->slug = $c->slug;
        $this->description = $c->description;
        $this->status = $c->status;

        $this->showModal = true;
    }

    public function save()
    {
        $this->validate();
        $this->status = $this->status ? 1 : 0;

        $data = [
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'status' => $this->status,
        ];

        if ($this->hotelCategoryId) {
            HotelCategory::findOrFail($this->hotelCategoryId)->update($data);
           $this->dispatch('success', 'Hotel category updated.');
        } else {
            HotelCategory::create($data);
           $this->dispatch('success', 'Hotel category created.');
        }

        $this->closeModal();
        $this->resetPage();
    }

    public function confirmDelete($id)
    {
        $this->hotelCategoryId = $id;
        $this->showDeleteModal = true;
    }

    public function delete()
    {
        if ($this->hotelCategoryId) {
            HotelCategory::destroy($this->hotelCategoryId);
           $this->dispatch('success', 'Hotel category deleted.');
        }
        $this->showDeleteModal = false;
        $this->resetPage();
    }

    public function cancelDelete()
    {
        $this->showDeleteModal = false;
        $this->hotelCategoryId = null;
    }

    public function toggleStatus($id)
    {
        $c = HotelCategory::findOrFail($id);
        $c->status = $c->status ? 0 : 1;
        $c->save();
       $this->dispatch('success', 'Status updated.');
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->resetForm();
    }

    protected function resetForm()
    {
        $this->hotelCategoryId = null;
        $this->name = null;
        $this->slug = null;
        $this->description = null;
        $this->status = 1;
        $this->resetValidation();
    }
}
