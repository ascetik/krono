<?php

namespace Ascetik\Krono\States;

use Ascetik\Krono\Krono;
use Ascetik\Krono\Traits\UseRunningState;
use Ascetik\Krono\Types\KronoState;

class ReadyState implements KronoState
{
    use UseRunningState;

    public const WORDING = 'ready';
    
    public readonly float $stopTime;

    public function __construct(
        protected Krono $krono,
        private float $startTime,

    ) {
        $this->stopTime = hrtime(true);
    }
    
    public function start(): float
    {
        return $this->run($this->krono);
    }

    public function stop(): float
    {
        return $this->stopTime;
    }

    public function restart(): float
    {
        return $this->start();
    }

    public function cancel(): void
    {
        $this->krono->reset();
    }

    public function elapsedTime(): float
    {
        return $this->stopTime - $this->startTime;
    }
}
