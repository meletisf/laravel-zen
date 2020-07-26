<?php

namespace Meletisf\Zen\Events;

use Meletisf\Zen\Interfaces\HealthCheckInterface;

class CheckFailed
{
    private $check;
    private $message;

    /**
     * CheckFailed constructor.
     *
     * @param HealthCheckInterface $check
     */
    public function __construct(HealthCheckInterface $check)
    {
        $this->check = $check;
        $this->message = $check->getMessage();
    }
}
