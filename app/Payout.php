<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Payout extends Model
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
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function (Payout $payout) {
            $payout->user_id = Auth::id();
        });
    }

    /**
     * Get the contest that owns the payment.
     */
    public function contest()
    {
        return $this->belongsTo(Contest::class);
    }
}
