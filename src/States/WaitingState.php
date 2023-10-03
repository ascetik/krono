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

use Ascetik\Krono\Exceptions\KronoException;
use Ascetik\Krono\Krono;
use Ascetik\Krono\Traits\UseRunningState;
use Ascetik\Krono\Types\KronoState;
use Ascetik\UnitscaleTime\Values\TimeScaleValue;

/**
 * Krono initial state
 *
 * @version 1.0.0
 */
class WaitingState implements KronoState
{
    use UseRunningState;

    public const WORDING = 'waiting';

    public function __construct(protected Krono $krono)
    {
    }

    /**
     * Start Krono
     */
    public function start(): float
    {
        return $this->setRunningState($this->krono);
    }

    /**
     * Stop time value is still 0
     */
    public function stop(): float
    {
        return 0;
    }

    /**
     * Simply start krono
     */
    public function restart(): float
    {
        return $this->start();
    }

    /**
     * Nothing to cancel on waiting state
     */
    public function cancel(): void
    {
        return;
    }

    /**
     * Return 0
     */
    public function elapsedTime(): float
    {
        return 0;
    }
}
