<?php

namespace Ascetik\Krono\Tests;

use Ascetik\Krono\Exceptions\KronoException;
use Ascetik\Krono\Krono;
use Ascetik\Krono\States\ReadyState;
use Ascetik\Krono\States\RunningState;
use Ascetik\Krono\States\WaitingState;
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
        $this->assertInstanceOf(RunningState::class, $this->krono->state());
    }

    public function testStartedKronoWontBeAffectedOnStartAgain()
    {
        $this->assertIsFloat($this->krono->start());
        $this->assertInstanceOf(RunningState::class, $this->krono->state());
    }

    public function testStartedKronoShouldBeAbleToStop()
    {
        $this->assertIsFloat($this->krono->stop());
        $this->assertInstanceOf(ReadyState::class, $this->krono->state());
    }

    public function testStartedKronoShouldBeAbleToCancel()
    {
        $this->krono->cancel();
        $this->assertInstanceOf(WaitingState::class, $this->krono->state());
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
