<?php

namespace App\Livewire\Admin\Testimonial;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Testimonial;
use Livewire\Attributes\Layout;

class TestimonialList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $perPage = 10;

    public $name;
    public $feedback;
    public $rating;
    public $testimonialId;
    public $showModal = false;

    protected $rules = [
        'name' => 'required|string|max:255',
        'feedback' => 'required|string|max:2000',
        'rating' => 'nullable|integer|min:0|max:5',
    ];

    protected $listeners = [
        'confirmDelete',
    ];
    #[Layout('components.layouts.admin')]
    public function render()
    {
        $query = Testimonial::query();

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('name', 'like', "%{$this->search}%")
                  ->orWhere('feedback', 'like', "%{$this->search}%");
            });
        }

        $testimonials = $query->orderBy('created_at', 'desc')
            ->paginate($this->perPage);

        return view('livewire.admin.testimonial.testimonial-list', [
            'testimonials' => $testimonials,
        ]);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function openCreateModal()
    {
        $this->resetForm();
        $this->testimonialId = null;
        $this->showModal = true;
    }

    public function openEditModal($id)
    {
        $t = Testimonial::findOrFail($id);
        $this->testimonialId = $t->id;
        $this->name = $t->name;
        $this->feedback = $t->feedback;
        $this->rating = $t->rating;
        $this->showModal = true;
    }

    public function save()
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'feedback' => $this->feedback,
            'rating' => $this->rating,
        ];

        if ($this->testimonialId) {
            Testimonial::find($this->testimonialId)->update($data);
            session()->flash('message', 'Testimonial updated.');
        } else {
            Testimonial::create($data);
            session()->flash('message', 'Testimonial created.');
        }

        $this->showModal = false;
        $this->resetForm();
    }

    public $confirmingDeleteId = null;

    public function confirmDelete($id)
    {
        $this->confirmingDeleteId = $id;
    }

    public function delete()
    {
        if ($this->confirmingDeleteId) {
            Testimonial::destroy($this->confirmingDeleteId);
            session()->flash('message', 'Testimonial deleted.');
            $this->confirmingDeleteId = null;
        }
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->resetForm();
    }

    protected function resetForm()
    {
        $this->name = null;
        $this->feedback = null;
        $this->rating = null;
    }
}
