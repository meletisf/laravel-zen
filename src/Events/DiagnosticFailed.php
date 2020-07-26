<?php

namespace Meletisf\Zen\Events;

use Meletisf\Zen\Interfaces\DiagnosticInterface;

class DiagnosticFailed
{
    private $check;
    private $message;

    /**
     * DiagnosticFailed constructor.
     *
     * @param DiagnosticInterface $check
     */
    public function __construct(DiagnosticInterface $check)
    {
        $this->check = $check;
        $this->message = $check->getMessage();
    }
}
