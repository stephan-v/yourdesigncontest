<?php

namespace App\Models;

use App\Presenters\PayoutPresenter;
use App\QueryScopes\PayoutScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payout extends Model
{
    use HasFactory;
    use PayoutPresenter;
    use PayoutScopes;

    /**
     * The initial payout state.
     *
     * @const string TEST
     */
    public const APPROVED = 'APPROVED';

    /**
     * The payout failed.
     *
     * @const string FAILED
     */
    public const FAILED = 'failed';

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
    public const SUCCEEDED = 'succeeded';

    /**
     * The attributes that are mass assignable.
     *
     * @var array $fillable
     */
    protected $fillable = [
        'amount',
        'currency',
        'contest_id',
        'transfer_id',
        'transferwise_transfer_id',
        'transferwise_customer_transaction_id',
        'user_id',
        'status',
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
