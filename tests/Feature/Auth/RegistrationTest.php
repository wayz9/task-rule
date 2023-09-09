<?php

use App\Livewire\Auth\Register;
use App\Models\Category;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Livewire\Livewire;

use function Pest\Laravel\get;

test('register screen can be rendered', function() {
    get(route('register'))
        ->assertOk();
});

test('guest can register', function() {
    Livewire::test(Register::class)
        ->set('name', 'Test User')
        ->set('email', 'test@example.com')
        ->set('password', 'StrongPassword123!')
        ->set('password_confirmation', 'StrongPassword123!')
        ->call('register')
        ->assertRedirect(RouteServiceProvider::HOME);

    expect(User::count())->toBeOne();

    expect($user = User::first())
        ->email->toBe('test@example.com')
        ->name->toBe('Test User');

    expect(Category::count())->toBeOne();
    expect(Category::first())
        ->name->toBe('Default')
        ->user_id->toBe($user->getKey());
});