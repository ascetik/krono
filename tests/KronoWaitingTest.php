<?php

namespace Ascetik\Krono\Tests;

use Ascetik\Krono\Exceptions\KronoException;
use Ascetik\Krono\Krono;
use PHPUnit\Framework\TestCase;

class KronoWaitingTest extends TestCase
{
    private Krono $krono;

    protected function setUp(): void
    {
        $this->krono = new Krono();
    }

    public function testKronoShouldBeWaitingToStart()
    {
        $this->assertSame('waiting', $this->krono->state());
    }

    public function testShouldBeAbleToStart()
    {
        echo $this->krono->state();
        $this->assertIsFloat($this->krono->start());
    }

    public function testShouldNotBeAbleToStop()
    {
        $this->expectException(KronoException::class);
        $this->krono->stop();
    }

    public function testShouldNotBeAbleTorestart()
    {
        $this->expectException(KronoException::class);
        $this->krono->restart();
    }

    public function testShouldNotBeAbleToCancel()
    {
        $this->expectException(KronoException::class);
        $this->krono->cancel();
    }

    public function testResultShouldBeNull()
    {
        $this->assertEquals(0, $this->krono->elapsedTime());
    }

}
