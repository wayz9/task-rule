<?php

namespace App\Livewire\Auth;

use App\Concerns\HasRateLimiting;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Rule;
use Livewire\Component;

class Login extends Component
{   
    use HasRateLimiting;

    #[Rule('required', 'string', 'email')]
    public string $email = '';

    #[Rule('required', 'string')]
    public string $password = '';

    #[Locked]
    public string $status = '';

    public function rendered()
    {
        if ($status = session('status')) {
            $this->js(<<<JS
                toast("{$status}", {
                    type: 'success',
                });
            JS);
        }
    }

    public function login()
    {
        $this->validate();

        if ($this->ensureIsNotRateLimited()) {
            $this->dispatch(
                'rate-limited', 
                timeLeft: RateLimiter::availableIn($this->getThrottleKey())
            );

            return;
        }

        if (! Auth::attempt([
            'email' => $this->email,
            'password' => $this->password,
        ], true)) {
            RateLimiter::hit($this->getThrottleKey());
            $this->addError('email', __('auth.failed'));
            $this->reset('password');
            return;
        }

        RateLimiter::clear($this->getThrottleKey());

        return redirect()->intended();
    }

    #[Layout('components.layouts.auth', ['title' => 'Login'])]
    public function render(): View
    {
        return view('livewire.auth.login');
    }
}
