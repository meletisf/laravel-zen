<?php

namespace Meletisf\Zen\Interfaces;

interface DiagnosticInterface
{
    /**
     * @return bool
     */
    public function check(): bool;

    /**
     * @return string
     */
    public function getMessage(): string;
}
