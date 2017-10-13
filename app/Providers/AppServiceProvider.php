<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Config;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        Config::set(['stadium' => [1 => 'オールド・トラフォード',2 => 'スタンフォードブリッジ']]);
        Config::set(['position' => [0 => 'GK',1 => 'DF',2 => 'MF',3 => 'FW']]);
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
