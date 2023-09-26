<?php

namespace Ascetik\Krono\States;

use Ascetik\Krono\Exceptions\KronoException;
use Ascetik\Krono\Krono;
use Ascetik\Krono\Types\KronoState;

class ReadyState implements KronoState
{
    public readonly float $stopTime;

    public function __construct(
        protected Krono $krono,
        private float $startTime,

    ) {
        $this->stopTime = hrtime(true);
    }
    public function start(): float
    {
        throw new KronoException('already running');
        return 0;
    }

    public function stop(): float
    {
        throw new KronoException('not running');
        return 0;
    }

    public function reset(): float
    {
        $this->cancel();
        return 0;
    }

    public function cancel(): void
    {
        $this->krono->setState(new InitialState($this->krono));
    }

    public function elapsedTime(): float
    {
        return $this->stopTime - $this->startTime;
    }
}
