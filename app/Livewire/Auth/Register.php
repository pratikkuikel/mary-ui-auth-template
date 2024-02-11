<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Mary\Traits\Toast;

class Register extends Component
{
    use Toast;

    public $title = 'Register here to continue !';
    public ?string $name;
    public ?string $email;
    public ?string $password;

    public function register()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
        ]);

        $user = User::create(['name' => $this->name, 'email' => $this->email, 'password' => Hash::make($this->password)]);

        $this->success('Registration successfull 😊 !');

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('home');
    }

    public function render()
    {
        return view('livewire.auth.register');
    }
}
