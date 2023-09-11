<?php

namespace App\Livewire;

use App\Models\Task;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Support\Str;

class ShowTask extends Component
{
    public Task $task;
    public array $links = [];

    public function boot()
    {
        $this->authorize('view', $this->task);
    }

    public function rendered()
    {
        // if ($status = session('saved')) {
        //     $this->js(<<<JS
        //         toast("{$status}", {
        //             type: 'success',
        //         });
        //     JS);
        // }

        // Debug why this is not working, is has to be with wire navigate or something.
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
        $urls = Str::of($this->task->description)
            ->matchAll('/\((https?:\/\/[^\s()]+)\)/')
            ->unique()
            ->toArray();

        return view('livewire.show-task', [
            'urls' => $urls,
        ]);
    }
}
