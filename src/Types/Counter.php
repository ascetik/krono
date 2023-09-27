<?php

namespace Ascetik\Krono\Types;

interface Counter
{
    public function start(): float;
    public function stop(): float;
    public function restart(): float;
    public function cancel(): void;
    public function elapsedTime(): float;
}
