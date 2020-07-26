<?php

namespace Meletisf\Zen;

use Meletisf\Zen\Events\DiagnosticFailed;
use Meletisf\Zen\Events\DiagnosticPassed;
use Meletisf\Zen\Exceptions\HealthCheckFailedException;
use Meletisf\Zen\Interfaces\DiagnosticInterface;

class Zen
{
    protected $diagnostics = [];

    protected $broadcast_events;

    protected $results;

    protected $is_healthy = true;

    /**
     * Zen constructor.
     *
     * @param array $health_checks
     * @param bool $broadcast_events
     */
    public function __construct(array $health_checks, bool $broadcast_events = true)
    {
        $this->addDiagnostics($health_checks);

        $this->broadcast_events = $broadcast_events;
    }

    /**
     * Add an array of diagnostics.
     *
     * @param array $diagnostics
     *
     * @return void
     */
    public function addDiagnostics(array $diagnostics): void
    {
        foreach ($diagnostics as $check) {
            $this->addDiagnostic(new $check());
        }
    }

    /**
     * Get an array with all the checks.
     *
     * @return array
     */
    public function getDiagnostics(): array
    {
        return $this->diagnostics;
    }

    /**
     * Add a single check.
     *
     * @param DiagnosticInterface $check
     *
     * @return void
     */
    public function addDiagnostic(DiagnosticInterface $check): void
    {
        array_push($this->diagnostics, $check);
    }

    /**
     * Run all checks.
     *
     * @return array
     */
    public function runDiagnostics()
    {
        foreach ($this->diagnostics as $healthcheck) {
            $this->runDiagnostic($healthcheck);
        }

        return [
            'is_healthy' => $this->is_healthy,
            'details' => $this->results
        ];
    }

    /**
     * @param DiagnosticInterface $diagnostic
     *
     * @return bool
     */
    public function runDiagnostic(DiagnosticInterface $diagnostic)
    {
        if (! $diagnostic->check()) {
            $this->fail($diagnostic);
            return false;
        } else {
            $this->passed($diagnostic);
            return true;
        }
    }

    /**
     * Handle a failure.
     *
     * @param DiagnosticInterface $diagnostic
     *
     * @return void
     */
    protected function fail(DiagnosticInterface $diagnostic): void
    {
        if ($this->broadcast_events) {
            event(new DiagnosticFailed($diagnostic));
        }

        // if a single check fails, then the node is unhealthy
        $this->is_healthy = false;

        $this->results[get_class($diagnostic)] = 'failed';
    }

    /**
     * Handle a success.
     *
     * @param DiagnosticInterface $diagnostic
     *
     * @return void
     */
    protected function passed(DiagnosticInterface $diagnostic): void
    {
        if ($this->broadcast_events) {
            event(new DiagnosticPassed($diagnostic));
        }

        $this->results[get_class($diagnostic)] = 'passed';
    }

    /**
     * Based on the results of the checks, respond accordingly
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response|void
     */
    public function respond()
    {
        if (! $this->is_healthy) {
            return abort(
                config('zen.abort_code', 500)
            );
        }

        return response(['is_healthy' => true], 200);
    }
}
