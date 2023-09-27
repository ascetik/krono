<?php

namespace Ascetik\Krono\Tests;

use Ascetik\Krono\Exceptions\KronoException;
use Ascetik\Krono\Krono;
use PHPUnit\Framework\TestCase;

class KronoRunningTest extends TestCase
{
    private Krono $krono;

    protected function setUp(): void
    {
        $this->krono = new Krono();
        $this->krono->start();
    }

    public function testStartedKronoShouldBeRunning()
    {
        $this->assertSame('running',$this->krono->state());
    }

    public function testStartedKronoWontBeAbleToStartAgain()
    {
        $this->expectException(KronoException::class);
        $this->krono->start();
    }

    public function testStartedKronoShouldBeAbleToStop()
    {
        $this->assertIsFloat($this->krono->stop());
    }

    public function testStartedKronoShouldBeAbleToCancel()
    {
        $this->krono->cancel();
        $this->assertSame('waiting', $this->krono->state());
    }

    public function testStartedKronoShouldBeAbleTorestart()
    {
        $this->krono->cancel();
        $startpoint = $this->krono->start();
        $restartpoint = $this->krono->restart();
        $this->assertTrue($restartpoint > $startpoint);
    }

    public function testResultShouldStopKronoAndReturnAValue()
    {
        $this->assertIsFloat($this->krono->elapsedTime());
    }
}
