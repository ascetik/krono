<?php

namespace Ascetik\Krono\Clocks;

use Ascetik\Krono\Types\Klock;
use Ascetik\UnitscaleTime\Factories\TimeScaler;

class HighResolutionKlock implements Klock
{
    public function now(): int|float
    {
        return hrtime(true);
    }

    public function toSeconds(float $time): int|float
    {
        return TimeScaler::unit($time)
            ->fromNano()
            ->toSeconds()
            ->raw();
    }
}
