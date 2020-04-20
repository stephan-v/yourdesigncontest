<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payout extends Model
{
    /**
     * The payout is pending awaiting a payout requets from the user.
     *
     * @const string PENDING
     */
    public const PENDING = 'pending';

    /**
     * The payout has been transferred using the payment gateway.
     *
     * @const string PENDING
     */
    public const TRANSFERRED = 'transferred';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'amount', 'currency', 'contest_id', 'transfer_id', 'user_id', 'status'
    ];

    /**
     * Get the contest that owns the payout.
     */
    public function contest()
    {
        return $this->belongsTo(Contest::class);
    }
}
