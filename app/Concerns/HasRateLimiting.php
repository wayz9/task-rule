<?php

namespace App\Concerns;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Livewire\Attributes\Computed;

trait HasRateLimiting
{
    private $decaySeconds = 60;
    private $maxHits = 5;

    #[Computed()]
    protected function getThrottleKey(): string
    {
        return Str::transliterate(Str::lower($this->email).'|'.request()->ip());
    }

    protected function ensureIsNotRateLimited(): bool
    {
        if (! RateLimiter::tooManyAttempts($this->getThrottleKey(), $this->maxHits)) {
            return false;
        }

        event(new Lockout(request()));

        return true;
    }
}
