<?php

namespace Meletisf\Zen;

use Meletisf\Zen\Events\CheckFailed;
use Meletisf\Zen\Events\CheckPassed;
use Meletisf\Zen\Exceptions\HealthCheckFailedException;
use Meletisf\Zen\Interfaces\HealthCheckInterface;

class Zen
{
    protected $health_checks = [];

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
        $this->addChecks($health_checks);

        $this->broadcast_events = $broadcast_events;
    }

    /**
     * Add an array of checks.
     *
     * @param array $checks
     *
     * @return void
     */
    public function addChecks(array $checks): void
    {
        foreach ($checks as $check) {
            $this->addCheck(new $check());
        }
    }

    /**
     * Get an array with all the checks.
     *
     * @return array
     */
    public function getChecks(): array
    {
        return $this->health_checks;
    }

    /**
     * Add a single check.
     *
     * @param HealthCheckInterface $check
     *
     * @return void
     */
    public function addCheck(HealthCheckInterface $check): void
    {
        array_push($this->health_checks, $check);
    }

    /**
     * Run all checks.
     *
     * @return array
     */
    public function runDiagnostics()
    {
        foreach ($this->health_checks as $healthcheck) {
            $this->runDiagnostic($healthcheck);
        }

        return [
            'is_healthy' => $this->is_healthy,
            'details' => $this->results
        ];
    }

    /**
     * @param HealthCheckInterface $healthCheck
     *
     * @return bool
     */
    public function runDiagnostic(HealthCheckInterface $healthCheck)
    {
        if (! $healthCheck->check()) {
            $this->fail($healthCheck);
            return false;
        } else {
            $this->passed($healthCheck);
            return true;
        }
    }

    /**
     * Handle a failure.
     *
     * @param HealthCheckInterface $check
     *
     * @return void
     */
    protected function fail(HealthCheckInterface $check): void
    {
        if ($this->broadcast_events) {
            event(new CheckFailed($check));
        }

        // if a single check fails, then the node is unhealthy
        $this->is_healthy = false;

        $this->results[get_class($check)] = 'failed';
    }

    /**
     * Handle a success.
     *
     * @param HealthCheckInterface $check
     *
     * @return void
     */
    protected function passed(HealthCheckInterface $check): void
    {
        if ($this->broadcast_events) {
            event(new CheckPassed($check));
        }

        $this->results[get_class($check)] = 'passed';
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
