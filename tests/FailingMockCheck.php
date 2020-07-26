<?php

namespace Meletisf\Zen\Test;

use Meletisf\Zen\Core\ZenCheckAbstract;
use Meletisf\Zen\Interfaces\HealthCheckInterface;

class FailingMockCheck extends ZenCheckAbstract implements HealthCheckInterface
{
    protected $message = 'failing_mock_check_message';

    /**
     * @return bool
     */
    public function check(): bool
    {
        return false;
    }
}
