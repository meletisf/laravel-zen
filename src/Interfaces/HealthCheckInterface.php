<?php

namespace Meletisf\Zen\Interfaces;

interface HealthCheckInterface
{
    /**
     * @return bool
     */
    public function check(): bool;

    public function getMessage(): string;
}
