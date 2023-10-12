<?php

declare(strict_types=1);

namespace Ascetik\Krono\Tests;

use Ascetik\Krono\Krono;
use Ascetik\Krono\States\ReadyState;
use Ascetik\Krono\States\RunningState;
use Ascetik\Krono\States\WaitingState;
use PHPUnit\Framework\TestCase;

class KronoReadyTest extends TestCase
{
    private Krono $krono;
    private float $start = 1000000;
    private float $stop = 2800000;

    protected function setUp(): void
    {

        $this->krono = new Krono();
        $state = new ReadyState($this->krono, $this->start, $this->stop);
        $this->krono->setState($state);
    }

    public function testKronoShouldBeReady()
    {
        $this->assertInstanceOf(ReadyState::class, $this->krono->state());
    }

    public function testStartOnReadyStateShouldRelaunchKrono()
    {
        $start = $this->krono->start();
        $this->assertInstanceOf(RunningState::class, $this->krono->state());
        $this->assertTrue($start > $this->start);
    }

    public function testReStartOnReadyStateShouldDoTheSame()
    {
        $start = $this->krono->restart();
        $this->assertInstanceOf(RunningState::class, $this->krono->state());
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
        $this->assertInstanceOf(WaitingState::class, $this->krono->state());
    }

    public function testElapsedTimeShouldBeFloat()
    {
        $this->assertIsFloat($this->krono->elapsedTime());
        $this->assertEquals(
            round(($this->stop - $this->start) * pow(10, -9), 6),
            $this->krono->elapsedTime()
        );
    }

    public function testKronoStringOutput()
    {
        $this->assertSame('0.0018s', (string) $this->krono->value());
    }

    public function testKronoStringAdjustedOutput()
    {
        $this->assertSame('1ms 800μs', (string) $this->krono->value()->detail());
    }
}
