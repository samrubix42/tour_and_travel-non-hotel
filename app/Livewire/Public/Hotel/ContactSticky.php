<?php

namespace App\Livewire\Public\Hotel;

use Livewire\Component;
use App\Models\ContactForHotel;
use App\Models\HotelCategory;

class ContactSticky extends Component
{
    public $show = false;
    public $name;
    public $category_id;
    public $no_of_persons;
    public $check_in;
    public $check_out;
    public $email;
    public $phone;
    public $message;

    public $categories = [];
    public $confirming = false;
    public $submitted = false;

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'category_id' => 'nullable|exists:hotel_categories,id',
            'no_of_persons' => 'nullable|string|max:50',
            'check_in' => 'nullable|date',
            'check_out' => 'nullable|date|after_or_equal:check_in',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:50',
            'message' => 'nullable|string|max:2000',
        ];
    }

    public function mount()
    {
        $this->categories = HotelCategory::where('status', 1)->get();
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

    public function closeThanks()
    {
        $this->submitted = false;
    }

    protected function resetForm()
    {
        $this->reset(['name','category_id','no_of_persons','check_in','check_out','email','phone','message']);
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

        ContactForHotel::create($data);


        $this->resetForm();
        $this->show = false;
        $this->confirming = false;
        $this->submitted = true;
    }

    public function render()
    {
        return view('livewire.public.hotel.contact-sticky');
    }
}
