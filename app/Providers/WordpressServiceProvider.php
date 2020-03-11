<?php

namespace App\Providers;

use App\Services\WordPress;
use Illuminate\Support\ServiceProvider;

class WordpressServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(WordPress::class, function () {
            return new Wordpress(
                config('services.wordpress.url')
            );
        });
    }
}
