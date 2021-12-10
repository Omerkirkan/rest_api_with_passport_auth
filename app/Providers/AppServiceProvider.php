<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Passport::tokensExpireIn(now()->addHour(2));
        Passport::refreshTokensExpireIn(now()->addHour(2));
        Passport::personalAccessTokensExpireIn(now()->addHour(2));
    }
}
