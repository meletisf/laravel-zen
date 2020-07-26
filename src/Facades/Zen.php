<?php

namespace Meletisf\Zen\Facades;

use Illuminate\Support\Facades\Facade;

/** @codeCoverageIgnore  */
class Zen extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'zen';
    }
}
