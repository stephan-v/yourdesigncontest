<?php

namespace App;

use App\Presenters\FilePresenter;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use FilePresenter;

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
}
