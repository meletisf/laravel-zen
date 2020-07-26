<?php

namespace Meletisf\Zen;

use Illuminate\Support\ServiceProvider;
use Meletisf\Zen\Console\Commands\RunDiagnostics;

class ZenServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     *
     * @return void
     */
    public function register()
    {
        $this->app->make('Meletisf\Zen\Http\Controllers\HealthController');

        $this->commands([
            RunDiagnostics::class
        ]);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if (config('zen.expose_default_routes')) {
            $this->loadRoutesFrom(__DIR__.'/routes.php');
        }

        $this->publishes([
            __DIR__ . '/config/zen.php' => config_path('zen.php'),
        ], 'zen-config');

        $this->app->singleton(\Meletisf\Zen\Facades\Zen::class, function () {
            return new Zen(
                config('zen.checklist'),
                config('zen.broadcast_events')
            );
        });

        $this->app->alias(\Meletisf\Zen\Facades\Zen::class, 'zen');
    }
}
