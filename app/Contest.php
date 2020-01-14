<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contest extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array $fillable
     */
    protected $fillable = [
        'description', 'expires_at', 'name'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array $dates
     */
    protected $dates = [
        'expires_at',
    ];

    /**
     * Get the transaction record associated with the transaction.
     */
    public function transaction()
    {
        return $this->hasOne(Transaction::class);
    }

    /**
     * Get the user that owns the phone.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Determines if the contest has been paid for.
     *
     * @return bool Whether the contest has been paid for or not.
     */
    public function isPaidFor()
    {
        return $this->transaction()->exists();
    }

    /**
     * Determines if the contest has not been paid for.
     *
     * @return bool Whether the contest has been paid for or not.
     */
    public function isNotPaidFor() {
        return !$this->isPaidFor();
    }
}
