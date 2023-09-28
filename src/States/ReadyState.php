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
 * Krono stopped State
 *
 * @version 1.0.0
 */
class ReadyState implements KronoState
{
    use UseRunningState;

    public const WORDING = 'ready';

    public readonly float $stopTime;
    
    public function __construct(
        protected Krono $krono,
        private float $startTime,

    ) {
        $this->stopTime = $this->krono->now();
    }

    /**
     * Restart Krono
     */
    public function start(): float
    {
        return $this->setRunningState($this->krono);
    }

    /**
     * Only return current stopTime
     */
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

    /**
     * Return difference between stop and start times
     */
    public function elapsedTime(): float
    {
        return $this->stopTime - $this->startTime;
    }
}
