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
 * Handle operations relative to
 * the "now" time value and its
 * conversion to seconds
 *
 * @version 1.0.0
 */
interface Klock
{
    public function now(): int|float;
    public function toSeconds(float $time): int|float;
}
