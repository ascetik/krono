<?php

namespace Ascetik\Krono\Tests;

use Ascetik\Krono\Krono;
use Ascetik\Krono\States\WaitingState;
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
        $this->assertInstanceOf(WaitingState::class, $this->krono->state());
    }

    public function testShouldBeAbleToStart()
    {
        $this->assertIsFloat($this->krono->start());
    }

    public function testRestartShouldStartKrono()
    {
        $this->assertIsFloat($this->krono->restart());
    }

    public function testShouldNotBeAbleToStop()
    {
        $this->assertEquals(0, $this->krono->stop());
    }

    public function testShouldNotChangeStateOnCancel()
    {
        $beforeState = $this->krono->state();
        $this->krono->cancel();
        $afterState = $this->krono->state();
        $this->assertSame($beforeState, $afterState);
    }

    public function testElapsedTimeShouldBeNull()
    {
        $this->assertEquals(0, $this->krono->elapsedTime());
    }

    public function testScaleValueShouldHaveZeroAsValue()
    {
        $this->assertSame('0s', (string) $this->krono->value());
    }
}
