<?php

namespace Ascetik\Krono\Exceptions;

class KronoException extends \RuntimeException
{
    public function __construct(string $message)
    {
        $this->message = 'Counter '.$message;
    }
}
