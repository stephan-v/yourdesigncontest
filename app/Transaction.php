<?php

namespace App;

use App\Presenters\TransactionPresenter;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use TransactionPresenter;

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
}
