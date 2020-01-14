<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'contest_id', 'payment_id'
    ];

    /**
     * Get the contest that owns the transaction.
     */
    public function contest()
    {
        return $this->belongsTo(Contest::class);
    }
}
