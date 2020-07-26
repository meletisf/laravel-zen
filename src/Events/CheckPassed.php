<?php

namespace Meletisf\Zen\Events;

use Meletisf\Zen\Interfaces\HealthCheckInterface;

class CheckPassed
{
    private $check;

    /**
     * CheckPassed constructor.
     *
     * @param HealthCheckInterface $check
     */
    public function __construct(HealthCheckInterface $check)
    {
        $this->check = $check;
    }
}
