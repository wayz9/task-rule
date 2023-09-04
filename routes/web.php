<?php

use App\Livewire\Dashboard;
use App\Livewire\ShowTask;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', Dashboard::class)
    ->middleware('auth', 'verified')
    ->name('home');

Route::get('/tasks/{task}', ShowTask::class)
    ->middleware('auth', 'verified') // Add Policy
    ->name('task.show');
