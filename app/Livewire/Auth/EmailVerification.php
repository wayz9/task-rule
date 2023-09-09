<?php

namespace App\Livewire\Auth;

use App\Concerns\HasRateLimiting;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\RateLimiter;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Illuminate\Support\Str;
use Livewire\Component;

class EmailVerification extends Component
{
    use HasRateLimiting;

    public function boot()
    {
        if (request()->user()->hasVerifiedEmail()) {
            return redirect()->intended(RouteServiceProvider::HOME);
        }
    }

    #[Computed()]
    public function email(): string
    {
        return auth()->user()->email;
    }

    public function requestVerificationEmail()
    {
        if ($this->ensureIsNotRateLimited()) {
            $this->dispatch(
                'rate-limited', 
                timeLeft: RateLimiter::availableIn($this->getThrottleKey())
            );

            return;
        }

        RateLimiter::hit($this->getThrottleKey());
        request()->user()->sendEmailVerificationNotification();

        $this->js(<<<JS
            toast('Verification email sent!', {
                type: 'success',
            })
        JS);
    }

    #[Layout('components.layouts.auth', ['title' => 'Email Verification Step'])]
    public function render()
    {
        return view('livewire.auth.email-verification');
    }
}
