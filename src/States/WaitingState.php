<?php

namespace Ascetik\Krono\States;

use Ascetik\Krono\Exceptions\KronoException;
use Ascetik\Krono\Krono;
use Ascetik\Krono\Traits\UseRunningState;
use Ascetik\Krono\Types\KronoState;

class WaitingState implements KronoState
{
    use UseRunningState;

    public const WORDING = 'waiting';

    public function __construct(protected Krono $krono)
    {
    }
    
    public function start(): float
    {
        return $this->run($this->krono);
        // $state = new RunningState($this->krono);
        // $this->krono->setState($state);
        // return $state->startValue;
    }

    public function stop(): float
    {
        $this->throw();
    }

    public function restart(): float
    {
        $this->throw();
    }

    public function cancel(): void
    {
        $this->throw();
    }

    public function elapsedTime(): float
    {
        return 0;
    }

    // public function wording(): string
    // {
    //     return 'wait';
    // }

    private function throw()
    {
        throw new KronoException('not running');
    }
}
