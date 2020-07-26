<?php

namespace Meletisf\Zen\Test;

use Meletisf\Zen\Events\DiagnosticFailed;
use Meletisf\Zen\Events\DiagnosticPassed;
use Meletisf\Zen\Zen;

class ZenTest extends TestCase
{
    /** @test */
    public function constructor_registers_the_checks()
    {
        $zd = new Zen([
            PassingMockCheck::class,
        ], null, false);

        $checks = $zd->getDiagnostics();

        $this->assertTrue(
            in_array(new PassingMockCheck(), $checks)
        );
    }

    /** @test */
    public function default_exception_can_be_overwritten()
    {
        $zd = new Zen([FailingMockCheck::class], MockException::class, false);
        $this->expectException(MockException::class);
        $zd->runDiagnostics();
    }

    /** @test */
    public function test_passing_behavior()
    {
        $zd = new Zen([], null, true);
        \Event::fake();

        $zd->runDiagnostic(new PassingMockCheck());
        \Event::assertDispatched(DiagnosticPassed::class);
    }

    /** @test */
    public function test_failing_behavior()
    {
        \Event::fake();
        $zd = new Zen([], MockException::class, true);

        try {
            $zd->runDiagnostic(new FailingMockCheck());
        } catch (\Exception $e) {
            \Event::assertDispatched(DiagnosticFailed::class);
        }
    }
}
