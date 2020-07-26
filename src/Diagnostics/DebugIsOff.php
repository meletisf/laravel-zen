<?php

namespace Meletisf\Zen\Diagnostics;

use Meletisf\Zen\Core\ZenCheckAbstract;
use Meletisf\Zen\Interfaces\DiagnosticInterface;

class DebugIsOff extends ZenCheckAbstract implements DiagnosticInterface
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
