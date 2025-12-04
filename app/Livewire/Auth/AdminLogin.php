<?php

namespace App\Livewire\Auth;

use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;


class AdminLogin extends Component
{
    public $email;
    public $password;
    public $remember = false;

    public function mount(){

        $this->email =  'admin@techonika.com';
        $this->password =  '123456789';
    }
    protected function rules()
    {
        return [
            'email' => 'required|email',
            'password' => 'required|string|min:4',
        ];
    }

    #[Layout('components.layouts.auth')]
    public function render()
    {
        return view('livewire.auth.admin-login');
    }

    public function login()
    {
        $this->validate();

        $credentials = ['email' => $this->email, 'password' => $this->password];

        if (Auth::attempt($credentials, $this->remember)) {
            session()->regenerate();
            return redirect()->intended('/admin');
        }

        $this->addError('email', 'The provided credentials do not match our records.');
    }
}
