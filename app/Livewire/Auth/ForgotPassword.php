<?php

namespace App\Livewire\Auth;

use App\Concerns\HasRateLimiting;
use App\Jobs\SendPasswordResetEmail;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\RateLimiter;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Component;

class ForgotPassword extends Component
{
    use HasRateLimiting;

    #[Rule(['required', 'email', 'string'])]
    public string $email = '';

    public function forgotPassword(): void
    {
        $this->validate();

        if ($this->ensureIsNotRateLimited()) {
            $this->dispatch(
                'rate-limited', 
                timeLeft: RateLimiter::availableIn($this->getThrottleKey())
            );

            return;
        }

        RateLimiter::hit($this->getThrottleKey());

        SendPasswordResetEmail::dispatchIf(
            User::whereEmail($this->email)->exists(),
            $this->email
        );

        $this->js(<<<JS
            toast('Password reset link sent!', {
                type: 'success',
            })
        JS);
    }

    #[Layout('components.layouts.auth', ['title' => 'Forgot Password'])]
    public function render(): View
    {
        return view('livewire.auth.forgot-password');
    }
}
