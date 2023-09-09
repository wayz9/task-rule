<?php

namespace App\Livewire\Auth;

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Livewire\Attributes\Layout;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Url;
use Livewire\Component;

class ResetPassword extends Component
{
    #[Url()]
    public string $email = '';
    
    public string $token = '';
    public string $password = '';
    public string $password_confirmation = '';

    public function mount(): void
    {
        $this->token = request()->route('token');
    }

    public function resetPassword()
    {
        Validator::make([
            'token' => $this->token,
            'email' => $this->email,
            'password' => $this->password,
            'password_confirmation' => $this->password_confirmation,
        ],[
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ])->validate();

        $status = Password::reset([
                'email' => $this->email,
                'password' => $this->password,
                'password_confirmation' => $this->password_confirmation,
                'token' => $this->token,
            ],
            function ($user) {
                $user->forceFill([
                    'password' => Hash::make($this->password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        if ($status != Password::PASSWORD_RESET) {
            $this->js(<<<JS
                toast("{$status}", 'danger');
            JS);

            return;
        }

        return redirect()->route('login')->with('status', __($status));
    }

    #[Layout('components.layouts.auth', ['title' => 'Reset Password'])]
    public function render(): View
    {
        return view('livewire.auth.reset-password');
    }
}
