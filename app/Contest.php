<?php

namespace App;

use App\Presenters\ContestPresenter;
use Illuminate\Database\Eloquent\Model;

class Contest extends Model
{
    use ContestPresenter;

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
     * Get the winning submission of the contest.
     */
    public function winner()
    {
        $submission = $this->submissions()->has('winner')->first();

        return optional($submission, function(Submission $submission) {
            return $submission->user;
        }) ?? new User();
    }
}
