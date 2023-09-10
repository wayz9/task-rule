<?php

namespace App\Livewire;

use App\Models\Task;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class EditTask extends Component
{
    use WithFileUploads;

    public Task $task;

    public $image;
    public $content;

    public function mount()
    {
        $this->content = $this->task->description;
    }

    public function boot()
    {
        $this->authorize('view', $this->task);
    }

    public function updatedImage()
    {
        // $property: The name of the current property that was updated
        $validator = validator()->make(
            ['image' => $this->image],
            ['image' => ['required', 'image', 'max:10000']],
        );

        if ($validator->fails()) {
            $this->reset('image');
            $this->js('toast(
                "The image must be a file of type: jpeg, png, jpg, gif, svg, webp, max: 2MB",
                {type: "error"}
            )');

            return;
        }

        $path = $this->image->storePublicly(
            "images/{$this->task->getKey()}",
        );

        $this->dispatch('image-uploaded', url: asset("storage/{$path}"));
    }

    public function save(): void
    {
        $this->validate([
            'content' => ['required', 'string'], // Max and Sanitize
        ]);

        $this->task->update([
            'description' => $this->content,
        ]);

        $this->redirectRoute('tasks.show', $this->task);
    }

    #[Layout('components.layouts.editor')]
    public function render(): View
    {
        return view('livewire.edit-task');
    }
}
