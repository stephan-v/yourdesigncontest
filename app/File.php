<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array $fillable
     */
    protected $fillable = [
        'name',
        'path',
        'size',
    ];

    /**
     * Get the file's size.
     *
     * @param int $bytes The file size in bytes.
     * @return string A human readable file size.
     */
    public function getSizeAttribute(int $bytes)
    {
        $size = ['B', 'kB', 'MB'];
        $factor = floor((strlen($bytes) - 1) / 3);

        return sprintf("%.2f", $bytes / pow(1024, $factor)) . @$size[$factor];
    }
}
