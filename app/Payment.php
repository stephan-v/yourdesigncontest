<?php

namespace App;

use App\Presenters\PaymentPresenter;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use PaymentPresenter;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'amount', 'contest_id', 'payment_id', 'user_id'
    ];

    /**
     * Get the contest that owns the payment.
     */
    public function contest()
    {
        return $this->belongsTo(Contest::class);
    }
}
