<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Socialite\One\TwitterProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        $this->bootTwitterSocialite();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
    private function bootTwitterSocialite()
    {
        $twitter = $this->app->make('Laravel\Socialite\Contracts\Factory');
        $twitter->extend(
            'spotify',
            function ($app) use ($twitter) {
                $config = $app['config']['services.twitter'];
                return $twitter->buildProvider(TwitterProvider::class, $config);
            }
        );
    }

}
