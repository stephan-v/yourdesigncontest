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
        'amount', 'contest_id', 'payment_id'
    ];

    /**
     * Get the contest that owns the transaction.
     */
    public function contest()
    {
        return $this->belongsTo(Contest::class);
    }

    /**
     * The payout amount for designers.
     *
     * @return int The payout price in cents.
     */
    public function payout()
    {
        return number_format(($this->amount / 100), 2);
    }
}
