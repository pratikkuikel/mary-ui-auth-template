<?php

namespace App\Livewire\Auth;

use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;
use Livewire\Component;
use DanHarrin\LivewireRateLimiting\WithRateLimiting;
use Mary\Traits\Toast;

class VerifyEmail extends Component
{
    use WithRateLimiting;
    use Toast;

    public function resendVerification()
    {
        try {
            $this->rateLimit(3);
        } catch (TooManyRequestsException $exception) {
            $this->error("Slow down! Please wait another {$exception->secondsUntilAvailable} seconds to send verification mail.");
        }

        auth()->user()->sendEmailVerificationNotification();

        $this->success("Verification Link sent, Please check your Mail");
    }

    public function render()
    {
        return view('livewire.auth.verify-email');
    }
}
