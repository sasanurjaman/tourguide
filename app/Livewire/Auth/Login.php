<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;

use Livewire\Component;

class Login extends Component
{
    public $email, $password, $remember = false;

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required|min:6',
    ];

    public function submit()
    {
        $data = $this->validate();

        if (Auth::attempt(
            ['email' => $data['email'], 'password' => $data['password']],
            $this->remember
        )) {
            session()->regenerate();
            return redirect()->intended('/');
        }

        $this->addError('email', 'Email atau password salah.');
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
