<?php

namespace App\Livewire;

use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Dashboard extends Component
{

    #[Layout('components.layouts.app')]
    public function render(): View
    {
        $tasks = [
            [
                'title' => 'Update the CSS styles for the homepage banner.',
                'priority' => 'important',
            ], [
                'title' => 'Debug the API endpoint to resolve the 500 internal server error.',
                'priority' => 'moderate',
            ], [
                'title' => 'Add a new page to the website for the new product launch.',
                'priority' => 'trivial',
            ], [
                'title' => 'Integrate a third-party authentication library for user login functionality.',
                'priority' => null,
            ], [
                'title' => 'Create unit tests for the new user registration form validation.',
                'priority' => null,
            ], [
                'title' => 'Optimize image assets for faster loading times on mobile devices.',
                'priority' => 'important',
            ], [
                'title' => 'Install and configure a logging framework to track errors and application events.',
                'priority' => 'moderate',
            ]
        ];

        return view('livewire.dashboard', [
            'tasks' => [...$tasks, ...$tasks],
        ]);
    }
}
