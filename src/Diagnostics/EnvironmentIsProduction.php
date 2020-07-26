<?php

namespace Meletisf\Zen\Diagnostics;

use Meletisf\Zen\Core\ZenCheckAbstract;
use Meletisf\Zen\Interfaces\DiagnosticInterface;

class EnvironmentIsProduction extends ZenCheckAbstract implements DiagnosticInterface
{
    protected $message = 'APP_ENV is not set to production!';

    /**
     * Check if the APP_ENV is correctly set to production.
     *
     * @return bool
     */
    public function check(): bool
    {
        if (config('app.env') != 'production') {
            return false;
        }

        return true;
    }
}
