<?php

namespace App\Livewire;

use App\Models\Task;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditTask extends Component
{
    use WithFileUploads;

    public Task $task;

    public $image;
    public $content = '';

    public function boot()
    {
        $this->authorize('view', $this->task);
    }

    public function updated($property)
    {
        // $property: The name of the current property that was updated
 
        if ($property === 'image') {
            $validator = validator()->make(
                ['image' => $this->image],
                ['image' => ['required', 'image', 'max:2024']],
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
    }

    #[Layout('components.layouts.editor')]
    public function render(): View
    {
        return view('livewire.edit-task');
    }
}
