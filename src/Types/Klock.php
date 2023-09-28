<?php

namespace Ascetik\Krono\Types;

interface Klock
{
    public function now(): int|float;
    public function toSeconds(float $time): int|float;
}
