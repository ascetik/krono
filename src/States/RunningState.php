<?php

namespace Ascetik\Krono\States;

use Ascetik\Krono\Krono;
use Ascetik\Krono\Traits\UseRunningState;
use Ascetik\Krono\Types\KronoState;

class RunningState implements KronoState
{
    use UseRunningState;

    public const WORDING = 'running';

    public readonly float $startValue;

    public function __construct(
        protected Krono $krono,
    ) {
        $this->startValue = hrtime(true);
    }

    public function start(): float
    {
        return $this->startValue;
    }

    public function stop(): float
    {
        $state = new ReadyState($this->krono, $this->startValue);
        $this->krono->setState($state);
        return $state->stopTime;
    }

    public function restart(): float
    {
        return $this->run($this->krono);
    }

    public function cancel(): void
    {
        $this->krono->reset();
    }

    public function elapsedTime(): float
    {
        $this->stop();
        return $this->krono->elapsedTime();
    }
}
