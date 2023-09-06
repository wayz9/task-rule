<?php

namespace App\Livewire;

use App\Models\Task;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Attributes\Layout;
use Livewire\Component;

class ShowTask extends Component
{
    use AuthorizesRequests;

    public Task $task;

    public function boot()
    {
        $this->authorize('view', $this->task);
    }
    
    #[Layout('components.layouts.app')]
    public function render(): View
    {
        return view('livewire.show-task');
    }
}
