<?php

namespace App\Http\Controllers;

use App\Contest;
use App\Notifications\SourceFilesAdded;
use Symfony\Component\HttpFoundation\Response;
use TusPhp\Events\TusEvent;
use TusPhp\Tus\Server;

class TusController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param Server $server The Tus server provider.
     * @return Response The Tus server response.
     */
    public function store(Server $server)
    {
        $server->event()->addListener('tus-server.upload.complete', function (TusEvent $event) {
            // Fetch the data which was set using the Uppy 'meta' key.
            $metadata = $event->getFile()->details()['metadata'];

            $contest = Contest::findOrFail($metadata['contest_id']);

            $contest->files()->create([
                'name' => $event->getFile()->getName(),
                'path' => "source-files/{$event->getFile()->getName()}",
                'size' => $event->getFile()->getFileSize(),
            ]);

            $contest->user->notify(new SourceFilesAdded($contest));
        });

        return $server->serve()->send();
    }
}
