<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;

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
    public function boot(): void
    {
        Event::listen(\SocialiteProviders\Manager\SocialiteWasCalled::class, function ($event) {
            $event->extendSocialite('google', \Laravel\Socialite\Two\GoogleProvider::class);
        });
    }
}
