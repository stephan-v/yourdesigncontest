<?php

namespace App;

use App\Presenters\PaymentPresenter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Payment extends Model
{
    use PaymentPresenter;

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

        static::creating(function (Payment $payment) {
            $payment->user_id = Auth::id();
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
