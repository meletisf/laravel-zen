<?php

namespace Meletisf\Zen\Diagnostics;

use Meletisf\Zen\Core\ZenCheckAbstract;
use Meletisf\Zen\Interfaces\HealthCheckInterface;

class AppKeyExists extends ZenCheckAbstract implements HealthCheckInterface
{
    protected $message = 'APP_KEY is not set!';

    /**
     * Check if the APP_KEY is set.
     *
     * @return bool
     */
    public function check(): bool
    {
        if (config('app.key') == null) {
            return false;
        }

        return true;
    }
}
