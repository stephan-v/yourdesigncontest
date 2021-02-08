<?php

namespace App\Observers;

use App\Models\File;
use Illuminate\Support\Facades\Storage;

class FileObserver
{
    /**
     * Handle the file "deleted" event.
     *
     * @param File $file The file which was just deleted.
     */
    public function deleted(File $file)
    {
        Storage::disk('public')->delete('source-files/' . $file->name);
    }
}
