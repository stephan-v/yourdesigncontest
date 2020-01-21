<?php

namespace App\Providers;

use App\File;
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

            // @TODO remove the static winner_id
            $server->event()->addListener('tus-server.upload.complete', function (TusEvent $event) {
                File::create([
                    'path' => $event->getFile()->getFilePath(),
                    'winner_id' => 1
                ]);
            });

            return $server;
        });
    }
}
