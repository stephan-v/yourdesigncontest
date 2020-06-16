<?php

namespace App\Providers;

use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;
use TusPhp\Tus\Server;

class TusServiceProvider extends ServiceProvider implements DeferrableProvider
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

            $path = Storage::disk('public')->path('source-files');

            $server->setApiPath('/tus');
            $server->setUploadDir($path);
            $server->setMaxUploadSize(10000000); // 10MB.

            return $server;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [Server::class];
    }
}
