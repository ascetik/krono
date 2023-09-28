<?php

/**
 * This is part of the Krono package.
 *
 * @package    krono
 * @category   Klock implementation
 * @license    https://opensource.org/license/mit/  MIT License
 * @copyright  Copyright (c) 2023, Vidda
 * @author     Vidda <vidda@ascetik.fr>
 */

 declare(strict_types=1);

namespace Ascetik\Krono\Clocks;

use Ascetik\Krono\Types\Klock;
use Ascetik\UnitscaleTime\Factories\TimeScaler;

/**
 * Use System high resolution time
 *
 * @version 1.0.0
 */
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
