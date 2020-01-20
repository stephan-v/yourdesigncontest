<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use TusPhp\Tus\Server as TusServer;

class TusServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('tus-server', function ($app) {
            $server = new TusServer('redis');

            $server
                ->setApiPath('/tus')
                ->setUploadDir(storage_path('app/public/tus'));

            return $server;
        });
    }
}
