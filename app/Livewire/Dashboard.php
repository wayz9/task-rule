<?php

namespace App\Livewire;

use App\Enums\Priority;
use App\Livewire\Forms\TaskForm;
use App\Models\Category;
use App\Models\Task;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Renderless;
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

    #[Renderless]
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

    public function changePriority(Task $task, ?string $priority): void
    {
        $priority = Priority::tryFrom($priority);

        if (! $priority) {
            $task->update(['priority' => null]);
            return;
        }

        if ($task->priority == $priority) {
            $this->js(<<<JS
                toast("Priority already set!", {
                    type: 'warning',
                });
            JS);
        }

        $this->authorize('update', $task);
        $task->update(['priority' => $priority]);
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
            ->orderBy('index')
            ->get()
            ->map(fn (Task $task) => [
                'id' => $task->getKey(),
                'title' => $task->title,
                'description' => $task->description,
                'priority' => (bool) $task->priority ? [
                    'value' => $task->priority->value,
                    'name' => $task->priority->getRealName(),
                    'class' => $task->priority->getPillClasses(),
                    'bg_color' => $task->priority->getBackgroundColor(),
                ] : null,
                'index' => $task->index,
                'created_at' => $task->created_at->format('d-M-y'),
                'view_route' => route('tasks.show', $task),
            ]);

        return view('livewire.dashboard', [
            'tasks' => $tasks,
        ]);
    }
}
