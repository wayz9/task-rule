<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Registered;

class CreateDefaultCategory
{
    /**
     * Handle the event.
     */
    public function handle(Registered $event): void
    {
        /** @var \App\Models\User $user */
        $user = $event->user;

        $user->categories()->create([
            'name' => 'Default',
            'is_default' => true,
            'slug' => 'default',
        ]);
    }
}
