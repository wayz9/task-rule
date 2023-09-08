<?php

namespace App\Livewire;

use App\Models\Task;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ShowTask extends Component
{
    public Task $task;

    public function boot()
    {
        $this->authorize('view', $this->task);
    }

    public function downloadTXT(): StreamedResponse
    {   
        $fileName = str($this->task->title)->slug()->append('.txt');

        return response()->streamDownload(
            fn () => print($this->task->description),
        $fileName);
    }
    
    #[Layout('components.layouts.app')]
    public function render(): View
    {
        return view('livewire.show-task');
    }
}
