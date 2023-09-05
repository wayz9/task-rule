<?php

namespace App\Enums;

enum Priority: int
{
    case Important = 1;
    case Moderate = 2;
    case Trivial = 3;
}
