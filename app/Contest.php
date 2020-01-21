<?php

namespace App;

use Carbon\Carbon;
use Exception;
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
     * Get the submissions for the contest.
     */
    public function submissions()
    {
        return $this->hasMany(Submission::class);
    }

    /**
     * Get the source files for the submission.
     */
    public function files()
    {
        return $this->hasMany(File::class);
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

    /**
     * Get the contests's expiration date.
     *
     * @param string $value The expiration timestamp.
     * @return string The human readable expiration date.
     * @throws Exception Thrown if a Carbon exception is thrown.
     */
    public function getExpiresAtAttribute($value)
    {
        return (new Carbon($value))->diffForHumans();
    }
}
