<?php

namespace App\Observers;

use App\Models\Task;

class TaskObserver
{
    /**
     * Handle the Task "creating" event.
     */
    public function creating(Task $task): void
    {
        if (is_null($task->index)) {
            $task->index = Task::query()
                ->where('category_id', $task->category_id)
                ->max('index') + 1;
        }

        Task::query()
            ->where('category_id', $task->category_id)
            ->where('index', '>=', $task->index)
            ->increment('index');
    }

    /**
     * Handle the Task "updating" event.
     */
    public function updating(Task $task): void
    {
        if ($task->isClean('index')) {
            return;
        }

        if (is_null($task->index)) {
            $task->index = Task::query()
                ->where('category_id', $task->category_id)
                ->max('index');
        }

        $indexRange = collect(
            $task->index,
            $task->getOriginal('index')
        );

        $task->getOriginal('index') > $task->index
            ? $indexRange
            : $indexRange->reverse();

        Task::query()
            ->whereNot('id', $task->id)
            ->where('category_id', $task->category_id)
            ->whereBetween('index', $indexRange->toArray())
            ->each(function (Task $iterable) use ($task) {
                $task->getOriginal('index') < $task->index
                    ? $iterable->index--
                    : $iterable->index++;

                $iterable->saveQuietly();
            });
    }

    /**
     * Handle the Task "deleted" event.
     */
    public function deleted(Task $task): void
    {
        Task::query()
            ->where('category_id', $task->category_id)
            ->where('index', '>', $task->index)
            ->each(function(Task $iterable) {
                $iterable->index--;
                $iterable->saveQuietly();
            });
    }
}
