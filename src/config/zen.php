<?php

return [

    /*
     * If set to TRUE, it will automatically register the /_health route.
     * You can set it to false and create your own controller which runs the
     * diagnostic checks.
     */
    'expose_default_routes' => env('ZEN_ENABLE_HEALTHCHECK_ROUTE', true),

    /*
     * You can also override the default route
     */
    'route' => env('ZEN_ROUTE', '_health'),

    'checklist' => [
        \Meletisf\Zen\Diagnostics\EnvFileExists::class,
        //\Meletisf\Zen\Diagnostics\AppKeyExists::class,
        //\Meletisf\Zen\Diagnostics\EnvironmentIsProduction::class,
        //\Meletisf\Zen\Diagnostics\DebugIsOff::class,
    ],

    /*
     * The code with which the default controller will respond in case of a failure
     */
    'abort_code' => 500,

    /*
     * If set to true, the Meletisf\Zen\Events\CheckFailed will be fired.
     */
    'broadcast_events' => env('ZEN_ENABLE_HEALTHCHECK_EVENTS', true),

];
