<?php

namespace Ascetik\Krono\States;

use Ascetik\Krono\Exceptions\KronoException;
use Ascetik\Krono\Krono;
use Ascetik\Krono\Types\KronoState;

class RunningState implements KronoState
{
    public readonly float $startValue;

    public function __construct(protected Krono $krono)
    {
        $this->startValue = hrtime(true);
    }

    public function start(): float
    {
        throw new KronoException('already running');
        return 0;
    }

    public function stop(): float
    {
        $state = new ReadyState($this->krono, $this->startValue);
        $this->krono->setState($state);
        return $state->stopTime;
    }

    public function reset(): float
    {
        $state = new self($this->krono);
        $this->krono->setState($state);
        return $state->startValue;
    }

    public function cancel(): void
    {
        $this->krono->setState(new InitialState($this->krono));
    }

    public function elapsedTime(): float
    {
        return 0;
    }
}
