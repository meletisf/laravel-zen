<?php

namespace Meletisf\Zen\Core;

abstract class ZenCheckAbstract
{
    /**
     * @var string
     */
    protected $message;

    /**
     * @var array
     */
    protected $config;

    /**
     * ZenCheckAbstract constructor.
     *
     * @param array|null $config
     */
    public function __construct(array $config = null)
    {
        $this->config = $config;
    }

    /**
     * Get the check message.
     *
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }
}
