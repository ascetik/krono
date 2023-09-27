<?php

declare(strict_types=1);

namespace Ascetik\Krono\Tests;

use Ascetik\Krono\Exceptions\KronoException;
use Ascetik\Krono\Krono;
use PHPUnit\Framework\TestCase;

class KronoReadyTest extends TestCase
{
    private Krono $krono;

    protected function setUp(): void
    {
        $this->krono = new Krono();
        $this->krono->start();
        // usleep(1000);
        $this->krono->stop();
    }

    public function testKronoShouldBeReady()
    {
        $this->assertSame('ready', $this->krono->state());
    }

    
}
