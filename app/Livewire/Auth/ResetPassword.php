<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Livewire\Component;
use Mary\Traits\Toast;
use Illuminate\Support\Str;

class ResetPassword extends Component
{
    use Toast;

    public ?string $token;
    public ?string $email;
    public ?string $password;
    public ?string $password_confirmation;

    public function mount()
    {
        $this->token = request()->token;
        $this->email = request()->query('email') ?? '';
    }

    public function updatePassword()
    {
        $this->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            [
                'email' => $this->email,
                'password' => $this->password,
                'password_confirmation' => $this->password_confirmation,
                'token' => $this->token,
            ],
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        $status === Password::PASSWORD_RESET
            ? $this->success(__($status))
            : $this->error(__($status));

        if ($status === Password::PASSWORD_RESET) {
            return redirect()->route('login');
        }
    }

    public function render()
    {
        return view('livewire.auth.reset-password');
    }
}
