<?php

namespace Meletisf\Zen\Events;

use Meletisf\Zen\Interfaces\DiagnosticInterface;

class DiagnosticPassed
{
    private $check;

    /**
     * DiagnosticPassed constructor.
     *
     * @param DiagnosticInterface $check
     */
    public function __construct(DiagnosticInterface $check)
    {
        $this->check = $check;
    }
}
