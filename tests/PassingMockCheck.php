<?php

namespace Meletisf\Zen\Test;

use Meletisf\Zen\Core\ZenCheckAbstract;
use Meletisf\Zen\Interfaces\HealthCheckInterface;

class PassingMockCheck extends ZenCheckAbstract implements HealthCheckInterface
{
    protected $message = 'passing_mock_check_message';

    /**
     * @return bool
     */
    public function check(): bool
    {
        return true;
    }
}
