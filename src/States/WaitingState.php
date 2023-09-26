<?php

namespace Ascetik\Krono\States;

use Ascetik\Krono\Exceptions\KronoException;
use Ascetik\Krono\Krono;
use Ascetik\Krono\Types\KronoState;

class WaitingState implements KronoState
{
    public function __construct(protected Krono $krono)
    {
    }
    public function start(): float
    {
        $state = new RunningState($this->krono);
        $this->krono->setState($state);
        return $state->startValue;
    }

    public function stop(): float
    {
        throw new KronoException('not running');
        return 0;
    }

    public function reset(): float
    {
        throw new KronoException('not running');
        return 0;
    }

    public function cancel(): void
    {
    }

    public function elapsedTime(): float
    {
        return 0;
    }

    public function word(): string
    {
        return 'waiting';
    }
}
