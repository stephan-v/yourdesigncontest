<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payout extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'amount', 'contest_id', 'transfer_id', 'user_id'
    ];

    /**
     * Get the contest that owns the payout.
     */
    public function contest()
    {
        return $this->belongsTo(Contest::class);
    }
}
