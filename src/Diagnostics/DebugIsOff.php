<?php

namespace Meletisf\Zen\Diagnostics;

use Meletisf\Zen\Core\ZenCheckAbstract;
use Meletisf\Zen\Interfaces\HealthCheckInterface;

class DebugIsOff extends ZenCheckAbstract implements HealthCheckInterface
{
    protected $message = 'APP_DEBUG is on!';

    /**
     * Check if the APP_DEBUG is off.
     *
     * @return bool
     */
    public function check(): bool
    {
        if (config('app.debug') == true) {
            return false;
        }

        return true;
    }
}
