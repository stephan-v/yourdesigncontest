<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use TusPhp\Events\TusEvent;
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

            $server->setApiPath('/tus');
            $server->setUploadDir(storage_path('app/uploads'));

            $server->event()->addListener('tus-server.upload.complete', function (TusEvent $event) {
                // @TODO attach the files to a winning submission.
                $fileMeta = $event->getFile()->details();
                $request  = $event->getRequest();
                $response = $event->getResponse();
            });

            return $server;
        });
    }
}
