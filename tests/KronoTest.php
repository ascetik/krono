<?php

use Ascetik\Krono\Krono;
use PHPUnit\Framework\TestCase;

class KronoTest extends TestCase
{
    public function testShouldBeOnWaitingState()
    {
        $krono = new Krono();
        $this->assertSame('waiting',$krono->state());
    }
}
