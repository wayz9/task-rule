<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

Route::get('/login', [AuthenticatedSessionController::class, 'create'])
    ->middleware('guest')
    ->name('login');

Route::post('/login', [AuthenticatedSessionController::class, 'store']);

Route::get('/register', [RegisteredUserController::class, 'create'])
    ->middleware('guest')
    ->name('register');

Route::post('/register', [RegisteredUserController::class, 'store'])
    ->middleware('guest');

Route::view('/forgot-password', 'auth.forgot-password')
    ->middleware('guest')
    ->name('password.request');

Route::post('/forgot-password', PasswordResetLinkController::class)
    ->middleware('guest', 'throttle:6,1')
    ->name('password.email');

Route::view('/reset-password/{token}', 'auth.reset-password')
    ->middleware('guest')
    ->name('password.reset');

Route::post('/reset-password', NewPasswordController::class)
    ->middleware('guest')
    ->name('password.update');

Route::any('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');

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