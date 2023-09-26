<?php

namespace Ascetik\Krono;

use Ascetik\Krono\Exceptions\KronoException;
use Ascetik\UnitscaleTime\Factories\TimeScaler;

class Krono
{
    private float $start = 0;
    private float $stop = 0;
    private bool $isConsumed = false;
    private bool $isRunning = false;

    public function start()
    {
        if ($this->isRunning) {
            throw new KronoException('already running');
        }
        $this->start = hrtime();
        $this->isRunning = true;
        return $this->start;
    }

    public function stop()
    {
        if (!$this->isRunning) {
            throw new KronoException('not started');
        }
        $this->stop = hrtime();
        // $this->isRunning = false;
        return $this->stop;
    }

    public function elapsedTime(): float
    {
        return $this->stop - $this->start;
    }

    public function __toString()
    {
        $time = $this->elapsedTime();
        $unit = TimeScaler::unit($time);
        return (string) $unit;
    }
}
