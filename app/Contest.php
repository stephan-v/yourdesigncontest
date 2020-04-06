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
        'description', 'expires_at', 'name', 'status', 'category'
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
     * Get the payment record associated with the contest.
     */
    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    /**
     * Get the payout record associated with the contest.
     */
    public function payout()
    {
        return $this->hasOne(Payout::class);
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
     * Get all of the contest comments.
     */
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable')->latest();
    }

    /**
     * Get the user that won the contest.
     */
    public function winner()
    {
        return $this
            ->hasOneThrough(User::class, Submission::class, 'contest_id', 'id', 'id', 'user_id')
            ->where('winner', true);
    }
}
