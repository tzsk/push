<?php

namespace Tzsk\Push\Provider;

use Illuminate\Support\ServiceProvider;
use Tzsk\Push\Factory\PusherFactory;
use Tzsk\Push\Pusher;

class PushServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            dirname(__DIR__).'/Config/tzsk-push.php' => config_path('push.php'),
        ]);
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('tzsk-push', function ($app) {
            return new Pusher(new PusherFactory());
        });
    }
}