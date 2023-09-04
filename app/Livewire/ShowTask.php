<?php

namespace App\Livewire;

use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

class ShowTask extends Component
{
    #[Layout('components.layouts.app')]
    public function render(): View
    {
        return view('livewire.show-task');
    }
}
