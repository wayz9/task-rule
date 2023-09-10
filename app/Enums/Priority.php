<?php

namespace App\Enums;

enum Priority: int
{
    case Important = 3;
    case Moderate = 2;
    case Trivial = 1;

    public function getPillClasses(): string
    {
        return match ($this) {
            self::Important => 'bg-violet-500/10 text-violet-800',
            self::Moderate => 'bg-yellow-500/10 text-yellow-700',
            self::Trivial => 'bg-gray-100 text-gray-700',
            default => '',
        };
    }

    public function getBackgroundColor(): string
    {
        return match ($this) {
            self::Important => 'bg-violet-500',
            self::Moderate => 'bg-yellow-500',
            self::Trivial => 'bg-gray-600',
            default => '',
        };
    }

    public function getRealName(): string
    {
        return match ($this) {
            self::Important => 'Important',
            self::Moderate => 'Moderate',
            self::Trivial => 'Trivial',
            default => '',
        };
    }
}
