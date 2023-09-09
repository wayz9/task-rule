<?php

use App\Models\User;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Livewire\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as AuthFacade;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

Route::get('/login', Auth\Login::class)
    ->middleware('guest')
    ->name('login');

Route::get('/register', Auth\Register::class)
    ->middleware('guest')
    ->name('register');

Route::get('/forgot-password', Auth\ForgotPassword::class)
    ->middleware('guest')
    ->name('password.request');

Route::get('/reset-password/{token}', Auth\ResetPassword::class)
    ->middleware('guest')
    ->name('password.reset');

Route::any('/logout', function(Request $request) {
    AuthFacade::guard('web')->logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return to_route('home');
})
    ->middleware('auth')
    ->name('logout');

Route::get('verify-email', Auth\EmailVerification::class)
    ->middleware('auth')
    ->name('verification.notice');

Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
    ->middleware(['auth', 'signed', 'throttle:6,1'])
    ->name('verification.verify');

Route::get('/auth/github/redirect', fn() => Socialite::driver('github')->redirect())
    ->middleware('guest')
    ->name('auth.github.redirect');

Route::get('/auth/github/callback', function() {
    $githubUser = Socialite::driver('github')->user();
    
    $user = User::updateOrCreate([
        'github_id' => $githubUser->id,
    ], [
        'name' => $githubUser->name,
        'email' => $githubUser->email,
        'github_token' => $githubUser->token,
        'github_refresh_token' => $githubUser->refreshToken,
        'email_verified_at' => now(),
    ]);

    auth()->login($user, true);

    return redirect()->intended(RouteServiceProvider::HOME);
})
    ->middleware('guest')
    ->name('auth.github.callback');