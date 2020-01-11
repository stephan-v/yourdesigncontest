<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contest extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array $fillable
     */
    protected $fillable = ['description', 'expires_at', 'name'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array $dates
     */
    protected $dates = [
        'expires_at',
    ];
}
