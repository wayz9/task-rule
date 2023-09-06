<?php

namespace App\Livewire;

use App\Models\Task;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

class EditTask extends Component
{
    public Task $task;

    public $content = '';

    public function boot()
    {
        $this->authorize('view', $this->task);
    }

    #[Layout('components.layouts.editor')]
    public function render(): View
    {
        return view('livewire.edit-task');
    }
}
