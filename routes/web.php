<?php

use App\Livewire\Dashboard;
use App\Livewire\EditTask;
use App\Livewire\ShowTask;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule;

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

Route::redirect('/', '/workspace');

Route::get('/workspace/{slug?}', Dashboard::class)
    ->middleware('auth', 'verified')
    ->name('home');

Route::get('/tasks/{task}', ShowTask::class)
    ->middleware('auth', 'verified')
    ->name('tasks.show');

Route::get('/tasks/{task}/edit', EditTask::class)
    ->middleware('auth', 'verified')
    ->name('tasks.edit');