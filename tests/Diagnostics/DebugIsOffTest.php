<?php

namespace Meletisf\Zen\Test\Diagnostics;

use Meletisf\Zen\Diagnostics\DebugIsOff;
use Meletisf\Zen\Test\TestCase;

class DebugIsOffTest extends TestCase
{
    /** @test */
    public function it_fails_when_debug_is_on()
    {
        \Config::set('app.debug', true);

        $this->assertFalse(
            (new DebugIsOff())->check()
        );
    }

    /** @test */
    public function it_passes_when_debug_is_off()
    {
        \Config::set('app.debug', false);

        $this->assertTrue(
            (new DebugIsOff())->check()
        );
    }
}
