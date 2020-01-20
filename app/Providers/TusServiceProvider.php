<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use TusPhp\Tus\Server;

class TusServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Server::class, function () {
            $server = new Server('redis');

            $server
                ->setApiPath('/tus')
                ->setUploadDir(storage_path('app/uploads'));

            return $server;
        });
    }
}
