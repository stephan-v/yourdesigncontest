<?php

namespace App\Presenters;

trait FilePresenter
{
    /**
     * Get the file's size.
     *
     * @param int $bytes The file size in bytes.
     * @return string A human readable file size.
     */
    public function getSizeAttribute(int $bytes): string
    {
        $size = ['B', 'kB', 'MB'];
        $factor = floor((strlen($bytes) - 1) / 3);

        return sprintf("%.2f", $bytes / pow(1024, $factor)) . @$size[$factor];
    }

    /**
     * Get the file's public path.
     *
     * @return string The public path to the file.
     */
    public function getPublicPathAttribute(): string
    {
        return storage_path("app/public/{$this->path}");
    }
}
