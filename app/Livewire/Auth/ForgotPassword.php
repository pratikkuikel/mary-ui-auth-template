<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Password;
use Livewire\Component;
use Mary\Traits\Toast;

class ForgotPassword extends Component
{
    use Toast;

    public ?string $email;

    public function sendVerificationMail()
    {
        $this->validate([
            'email' => 'required|email'
        ]);

        $status = Password::sendResetLink(
            ['email' => $this->email]
        );

        $status === Password::RESET_LINK_SENT
            ? $this->success(__($status))
            : $this->error(__($status));
    }

    public function render()
    {
        return view('livewire.auth.forgot-password');
    }
}
