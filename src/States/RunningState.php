<?php

namespace Ascetik\Krono\States;

use Ascetik\Krono\Exceptions\KronoException;
use Ascetik\Krono\Krono;
use Ascetik\Krono\Types\KronoState;

class RunningState implements KronoState
{
    public const WORDING = 'running';


    public function __construct(
        protected Krono $krono,
        public readonly float $startValue
    ) {
    }

    public function start(): float
    {
        throw new KronoException('already running');
        return 0;
    }

    public function stop(): float
    {
        $state = new ReadyState($this->krono, $this->startValue, hrtime(true));
        $this->krono->setState($state);
        return $state->stopTime;
    }

    public function reset(): float
    {
        $state = new self($this->krono, hrtime(true));
        $this->krono->setState($state);
        return $state->startValue;
    }

    public function cancel(): void
    {
        $this->krono->setState(new WaitingState($this->krono));
    }

    public function elapsedTime(): float
    {
        $this->stop();
        return $this->krono->elapsedTime();
    }
}
