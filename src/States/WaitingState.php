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
     * Can't stop not started Krono
     *
     * @throws KronoException
     */
    public function stop(): float
    {
        $this->throw();
    }

    /**
     * Can't restart not started Krono
     *
     * @throws KronoException
     */
    public function restart(): float
    {
        $this->throw();
    }

    /**
     * Can't cancel not started Krono
     *
     * @throws KronoException
     */
    public function cancel(): void
    {
        $this->throw();
    }

    /**
     * Return Null elapsed time if Krono
     * did not start
     *
     * @throws KronoException
     */
    public function elapsedTime(): float
    {
        return 0;
    }

    private function throw()
    {
        throw new KronoException('not running');
    }
}
