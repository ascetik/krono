<?php

declare(strict_types=1);

namespace Ascetik\Krono\Tests;

use Ascetik\Krono\Krono;
use PHPUnit\Framework\TestCase;

class KronoReadyTest extends TestCase
{
    private Krono $krono;
    private float $start = 0;
    private float $stop = 0;

    protected function setUp(): void
    {
        $this->krono = new Krono();
        $this->start = $this->krono->start();
        $this->stop = $this->krono->stop();
    }

    public function testKronoShouldBeReady()
    {
        $this->assertSame('ready', $this->krono->state());
    }

    public function testStartOnReadyStateShouldRelaunchKrono()
    {
        $start = $this->krono->start();
        $this->assertSame('running', $this->krono->state());
        $this->assertTrue($start > $this->start);
    }

    public function testReStartOnReadyStateShouldDoTheSame()
    {
        $start = $this->krono->restart();
        $this->assertSame('running', $this->krono->state());
        $this->assertTrue($start > $this->start);
    }

    public function testStopOnReadyStateShouldJustReturnEndValue()
    {
        $stop = $this->krono->stop();
        $this->assertSame($this->stop, $stop);
    }

    public function testCancelReadyStateInitializesKrono()
    {
        $this->krono->cancel();
        $this->assertSame('waiting', $this->krono->state());
    }

    public function testElapsedTimeShouldBeFloat()
    {
        $this->assertIsFloat($this->krono->elapsedTime());
    }

}
