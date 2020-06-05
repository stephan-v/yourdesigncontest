<?php

namespace App;

use App\Casts\Money;
use App\Presenters\PayoutPresenter;
use App\QueryScopes\PayoutScopes;
use Illuminate\Database\Eloquent\Model;

class Payout extends Model
{
    use PayoutPresenter;
    use PayoutScopes;

    /**
     * The payout is pending awaiting a payout request from the user.
     *
     * @const string PENDING
     */
    public const PENDING = 'pending';

    /**
     * The payout has been transferred using the payment gateway.
     *
     * @const string SUCCEEDED
     */
    public const SUCCEEDED = 'SUCCEEDED';

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
        'amount', 'currency', 'contest_id', 'transfer_id', 'user_id', 'status'
    ];

    /**
     * Get the contest that owns the payout.
     */
    public function contest()
    {
        return $this->belongsTo(Contest::class);
    }

    /**
     * Get the user that belongs to the payout.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
