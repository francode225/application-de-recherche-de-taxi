<?php

namespace App\Providers;

use Illuminate\Support\Facades\Notification;
use Illuminate\Support\ServiceProvider;
use Nette\Schema\Schema as NetteSchema;
use Illuminate\Support\Facades\Schema;
use NotificationChannels\Twilio\TwilioChannel;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */

    public function boot(){
        Schema::defaultStringLength(191);

        Notification::extend('twilio', function ($app) {
            return new TwilioChannel($app['config']['services.twilio']);
        });
    }
}
