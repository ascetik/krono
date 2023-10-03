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

namespace Ascetik\Krono\Types;

/**
 * Counter implementation contract
 *
 * @version 1.0.0
 */
interface Counter
{
    public function start(): float;
    public function stop(): float;
    public function restart(): float;
    public function cancel(): void;
    public function elapsedTime(): float;
}
