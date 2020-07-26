<?php

namespace Meletisf\Zen\Test;

use Meletisf\Zen\Core\ZenCheckAbstract;
use Meletisf\Zen\Interfaces\DiagnosticInterface;

class PassingMockCheck extends ZenCheckAbstract implements DiagnosticInterface
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
