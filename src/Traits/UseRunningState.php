<?php

/**
 * This is part of the Krono package.
 *
 * @package    krono
 * @category   Krono State trait
 * @license    https://opensource.org/license/mit/  MIT License
 * @copyright  Copyright (c) 2023, Vidda
 * @author     Vidda <vidda@ascetik.fr>
 */

declare(strict_types=1);

namespace Ascetik\Krono\Traits;

use Ascetik\Krono\Krono;
use Ascetik\Krono\States\RunningState;

/**
 * Provide and set a RunningState
 *
 * This trait is shared by all KronoStates
 *
 * @version 1.0.0
 */
trait UseRunningState
{
    private function setRunningState(Krono $krono): float
    {
        $state = new RunningState($krono, $krono->now());
        $krono->setState($state);
        return $state->startValue;
    }
}
