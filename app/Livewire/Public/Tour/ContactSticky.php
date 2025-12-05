<?php

namespace App\Livewire\Public\Tour;

use Livewire\Component;
use App\Models\ContactForTour;
use App\Models\Destination;

class ContactSticky extends Component
{
    public $show = false;
    public $name;
    public $destination_id;
    public $email;
    public $phone;
    public $message;
    public $check_in_date;
    public $check_out_date;
    public $no_of_adults;
    public $children;
    public $category_of_hotels;
    public $consent = false;

    public $destinations = [];
    public $confirming = false;
    public $submitted = false;

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'destination_id' => 'nullable|exists:destinations,id',
            'email' => 'nullable|email|max:255',
            'phone' => 'required|string|max:50',
            'message' => 'nullable|string|max:2000',
            'check_in_date' => 'nullable|date',
            'check_out_date' => 'nullable|date',
            'no_of_adults' => 'required|integer|min:1',
            'children' => 'nullable|string|max:255',
            'consent' => 'nullable|boolean',
        ];
    }

    public function mount()
    {
        $this->destinations = Destination::where('status',1)->get();
    }

    public function open()
    {
        $this->show = true;
    }

    public function close()
    {
        $this->resetForm();
        $this->show = false;
        $this->confirming = false;
    }

    protected function resetForm()
    {
        $this->reset(['name','destination_id','email','phone','message','check_in_date','check_out_date','no_of_adults','children','category_of_hotels','consent']);
    }

    public function promptConfirm()
    {
        $this->validate();
        $this->confirming = true;
    }

    public function save()
    {
        $data = $this->validate();
        $data['ip'] = request()->ip();
        $data['status'] = 'pending';

        ContactForTour::create($data);

        $this->dispatch('notify', ['type' => 'success', 'message' => 'Request submitted. We will contact you soon.']);

        $this->resetForm();
        $this->show = false;
        $this->confirming = false;
        $this->submitted = true;
    }

    public function closeThanks()
    {
        $this->submitted = false;
    }

    public function render()
    {
        return view('livewire.public.tour.contact-sticky');
    }
}
