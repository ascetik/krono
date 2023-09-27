<?php

/**
 * This is part of the UnitScale package.
 *
 * @package    unitscale-core
 * @category   Exception
 * @license    https://opensource.org/license/mit/  MIT License
 * @copyright  Copyright (c) 2023, Vidda
 * @author     Vidda <vidda@ascetik.fr>
 */

 declare(strict_types=1);

namespace Ascetik\Krono\Exceptions;

/**
 * @version 1.0.0
 */
class KronoException extends \RuntimeException
{
    public function __construct(string $message)
    {
        $this->message = 'Counter '.$message;
    }
}
