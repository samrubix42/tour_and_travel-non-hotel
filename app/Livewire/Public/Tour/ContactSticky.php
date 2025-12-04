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
    public $no_of_persons;
    public $travel_date;
    public $email;
    public $phone;
    public $message;

    public $destinations = [];
    public $confirming = false;
    public $submitted = false;

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'destination_id' => 'nullable|exists:destinations,id',
            'no_of_persons' => 'nullable|integer|min:1',
            'travel_date' => 'nullable|date',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:50',
            'message' => 'nullable|string|max:2000',
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
        $this->reset(['name','destination_id','no_of_persons','travel_date','email','phone','message']);
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
