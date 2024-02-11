<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;
use Mary\Traits\Toast;

class Login extends Component
{
    use Toast;

    public $title = 'Welcome to the future !';
    public ?string $email;
    public ?string $password;

    public function authenticate()
    {
        $this->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            request()->session()->regenerate();
            $this->success('Logged in successfully', position: 'toast-top');
            return Redirect::route('features');
        } else {
            $this->error("Cannot verify the credentials !", position: 'toast-top');
        }
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
