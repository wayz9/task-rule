<?php

use App\Livewire\Auth\ForgotPassword;
use App\Livewire\Auth\ResetPassword as AuthResetPassword;
use App\Models\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\Facades\Notification;
use Livewire\Livewire;

use function Pest\Laravel\get;

test('forgot password screen can be rendered', function () {
    get(route('password.request'))
        ->assertOk();
});

test('reset password link can be requested', function() {
    Notification::fake();
    $user = User::factory()->create();

    Livewire::test(ForgotPassword::class)
        ->set('email', $user->email)
        ->call('forgotPassword')
        ->assertHasNoErrors()
        ->assertNotDispatched('rate-limited');

    Notification::assertSentTo($user, ResetPassword::class);
});

test('reset password screen can be rendered', function() {
    Notification::fake();
    $user = User::factory()->create();

    Livewire::test(ForgotPassword::class)
        ->set('email', $user->email)
        ->call('forgotPassword');

    Notification::assertSentTo($user, ResetPassword::class, function ($notification) use ($user) {
        get(route('password.reset', [
            'token' => $notification->token,
            'email' => $user->email,
        ]))->assertOk();

        return true;
    });
});

test('password can be reset with valid token', function() {
    Notification::fake();
    $user = User::factory()->create();

    Livewire::test(ForgotPassword::class)
        ->set('email', $user->email)
        ->call('forgotPassword');

    Notification::assertSentTo($user, ResetPassword::class, function ($notification) use ($user) {
        Livewire::test(AuthResetPassword::class)
            ->set('email', $user->email)
            ->set('token', $notification->token)
            ->set('password', 'NewPassword123!')
            ->set('password_confirmation', 'NewPassword123!')
            ->call('resetPassword')
            ->assertHasNoErrors()
            ->assertRedirect(route('login'));

        return true;
    });
});