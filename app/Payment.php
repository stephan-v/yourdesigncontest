<?php

namespace App;

use App\Casts\Money;
use App\Presenters\PaymentPresenter;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use PaymentPresenter;

    /**
     * The attributes that should be cast.
     *
     * @var array $casts
     */
    protected $casts = [
        'amount' => Money::class,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array $fillable
     */
    protected $fillable = [
        'amount', 'fee', 'contest_id', 'payment_id', 'user_id'
    ];

    /**
     * Get the contest that owns the payment.
     */
    public function contest()
    {
        return $this->belongsTo(Contest::class);
    }
}
