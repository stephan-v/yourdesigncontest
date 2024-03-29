<?php

namespace App\Models;

use App\Presenters\PaymentPresenter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    use PaymentPresenter;

    /**
     * The attributes that are mass assignable.
     *
     * @var array $fillable
     */
    protected $fillable = [
        'amount',
        'currency',
        'fee',
        'contest_id',
        'payment_id',
        'user_id',
    ];

    /**
     * Get the contest that owns the payment.
     */
    public function contest()
    {
        return $this->belongsTo(Contest::class);
    }

    /**
     * Get the user that owns the phone.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
