<?php

/**
 * This is part of the Krono package.
 *
 * @package    krono
 * @category   Interface
 * @license    https://opensource.org/license/mit/  MIT License
 * @copyright  Copyright (c) 2023, Vidda
 * @author     Vidda <vidda@ascetik.fr>
 */

declare(strict_types=1);

namespace Ascetik\Krono;

use Ascetik\Krono\States\WaitingState;
use Ascetik\Krono\Types\Counter;
use Ascetik\Krono\Types\KronoState;
use Ascetik\UnitscaleTime\Factories\TimeScaler;

/**
 * Krono is a simple time counter.
 *
 * Start Krono at any time, stop it
 * then and get the interval between
 * those two points.
 *
 * It works using states which depend on
 * Krono working state at different steps.
 * The initial state allows only start() command
 * The running state reacts on stop()
 * The ready state returns the elased time
 * between start and end
 *
 * @version 1.0.0
 */
class Krono implements Counter
{
    private KronoState $state;

    public function __construct()
    {
        $this->reset();
    }

    public function setState(KronoState $state): self
    {
        $this->state = $state;
        return $this;
    }

    public function start(): float
    {
        return $this->state->start();
    }

    public function stop(): float
    {
        return $this->state->stop();
    }

    public function cancel(): void
    {
        $this->state->cancel();
    }

    public function restart(): float
    {
        return $this->state->restart();
    }

    public function reset(): void
    {
        $this->state = new WaitingState($this);
    }

    public function elapsedTime(): float
    {
        return $this->state->elapsedTime();
    }

    public function __toString()
    {
        $time = $this->elapsedTime();
        $seconds = TimeScaler::unit($time)
            ->fromNano()
            ->toSeconds();
        $unit = TimeScaler::adjust(round($seconds->raw(), 3));
        return (string) $unit;
    }

    public function state(): string
    {
        return $this->state::WORDING;
    }
}
