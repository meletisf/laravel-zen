<?php

namespace Meletisf\Zen\Diagnostics;

use Meletisf\Zen\Core\ZenCheckAbstract;
use Meletisf\Zen\Interfaces\DiagnosticInterface;

class EnvFileExists extends ZenCheckAbstract implements DiagnosticInterface
{
    protected $message = '.env does not exist!';

    /**
     * Check if the .env file exists.
     *
     * TODO: Make this part testable
     *
     * @codeCoverageIgnore
     *
     * @return bool
     */
    public function check(): bool
    {
        return file_exists(base_path('.env'));
    }
}
