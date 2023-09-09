<?php

use App\Livewire\Auth\Login;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Livewire\Livewire;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertAuthenticatedAs;
use function Pest\Laravel\assertGuest;
use function Pest\Laravel\get;

test('login screen can be rendered', function() {
    get(route('login'))
        ->assertOk();
});

test('users can authenticate using the login screen', function() {
    mock(\Illuminate\Contracts\Session\Session::class, function ($mock) {
        $mock->shouldReceive('regenerate')->andReturnNull();
    });

    $user = User::factory()->create();

    Livewire::test(Login::class)
        ->set('email', $user->email)
        ->set('password', 'password')
        ->call('login')
        ->assertRedirect();

    assertAuthenticatedAs($user);
});

test('users can not authenticate with invalid password', function() {
    $user = User::factory()->create();

    Livewire::test(Login::class)
        ->set('email', $user->email)
        ->set('password', 'wrong-password')
        ->call('login')
        ->assertHasErrors('email');

    assertGuest();
});

test('users can logout', function() {
    actingAs(User::factory()->create())
        ->get(route('logout'))
        ->assertRedirect();

    assertGuest();
});