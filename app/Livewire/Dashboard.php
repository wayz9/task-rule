<?php

namespace App\Livewire;

use App\Livewire\Forms\TaskForm;
use App\Models\Category;
use App\Models\Task;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Dashboard extends Component
{
    public $slug;

    public TaskForm $taskForm;
 
    #[Computed]
    public function currentCategory(): Category
    {
        return Category::query()
            ->when(
                $this->slug != '',
                fn (Builder $query) => $query->where('slug', $this->slug),
                fn (Builder $query) => $query->defaultCategory()
            )
            ->whereBelongsTo(auth()->user())
            ->firstOrFail();
    }

    public function delete(Task $task)
    {
        $this->authorize('delete', $task);

        $task->delete();
        $this->js(<<<JS
            toast("Task deleted successfully!", {
                type: 'success',
            });
        JS);
    }

    #[Computed]
    public function categories(): Collection
    {
        return Category::query()
            ->whereBelongsTo(auth()->user())
            ->get()
            ->map(fn (Category $category) => [
                'slug' => $category->getKey(),
                'name' => $category->name,
                'route' => route('home', $category->slug),
                'active' => $category->is($this->currentCategory),
            ]);
    }

    public function add(): void
    {
        $this->taskForm->validate();

        Task::create([
            'title' => $this->taskForm->title,
            'category_id' => $this->currentCategory->id,
            'user_id' => auth()->id(),
        ]);

        $this->taskForm->reset();
        $this->dispatch('scrollToBottom');
    }

    #[Layout('components.layouts.app')]
    public function render(): View
    {
        $tasks = Task::query()
            ->whereBelongsTo(auth()->user())
            ->whereBelongsTo($this->currentCategory)
            ->get();

        return view('livewire.dashboard', [
            'tasks' => $tasks,
        ]);
    }
}
