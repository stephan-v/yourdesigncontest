<?php

namespace App\Providers;

use App\Contest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;
use TusPhp\Events\TusEvent;
use TusPhp\Tus\Server;

class TusServiceProvider extends ServiceProvider
{
    /**
     * The directory to save the tus uploaded files.
     *
     * @var string $directory
     */
    private $directory = 'source-files';

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Server::class, function () {
            $server = new Server('redis');

            $path = Storage::disk('public')->path($this->directory);

            $server->setApiPath('/tus');
            $server->setUploadDir($path);
            $server->setMaxUploadSize(10000000); // 10MB.

            // @TODO remove the static winner_id
            $server->event()->addListener('tus-server.upload.complete', function (TusEvent $event) {
                Contest::find(1)->files()->create([
                    'name' => $event->getFile()->getName(),
                    'path' => "{$this->directory}/{$event->getFile()->getName()}",
                    'size' => $event->getFile()->getFileSize(),
                ]);
            });

            return $server;
        });
    }
}
