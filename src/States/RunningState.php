<?php

/**
 * This is part of the Krono package.
 *
 * @package    krono
 * @category   Krono State
 * @license    https://opensource.org/license/mit/  MIT License
 * @copyright  Copyright (c) 2023, Vidda
 * @author     Vidda <vidda@ascetik.fr>
 */

declare(strict_types=1);

namespace Ascetik\Krono\States;

use Ascetik\Krono\Krono;
use Ascetik\Krono\Traits\UseRunningState;
use Ascetik\Krono\Types\KronoState;

/**
 * Krono started state
 *
 * @version 1.0.0
 */
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

    /**
     * Only return current startValue
     */
    public function start(): float
    {
        return $this->startValue;
    }

    /**
     * Switch Krono state to ready
     */
    public function stop(): float
    {
        $state = new ReadyState($this->krono, $this->startValue);
        $this->krono->setState($state);
        return $state->stopTime;
    }

    /** Restart Krono with a refreshed Running state */
    public function restart(): float
    {
        return $this->setRunningState($this->krono);
    }

    /** Just reselt Krono */
    public function cancel(): void
    {
        $this->krono->reset();
    }

    /**
     * Stop Krono and return
     * its ready elapsedTime
     */
    public function elapsedTime(): float
    {
        $this->stop();
        return $this->krono->elapsedTime();
    }
}
