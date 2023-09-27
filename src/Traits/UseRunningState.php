<?php

namespace Ascetik\Krono\Traits;

use Ascetik\Krono\Krono;
use Ascetik\Krono\States\RunningState;

trait UseRunningState
{
    private function run(Krono $krono): float
    {
        $state = new RunningState($krono);
        $krono->setState($state);
        return $state->startValue;
    }
}
