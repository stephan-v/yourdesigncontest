<?php

namespace App;

use App\Presenters\SubmissionPresenter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Submission extends Model
{
    use SoftDeletes;
    use SubmissionPresenter;

    /**
     * The accessors to append to the model's array form.
     *
     * @var array $appends
     */
    protected $appends = ['path'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array $fillable
     */
    protected $fillable = [
        'description',
        'filename',
        'order',
        'rating',
        'title',
        'user_id',
        'winner'
    ];

    /**
     * Get the contest that owns the submission.
     */
    public function contest()
    {
        return $this->belongsTo(Contest::class);
    }

    /**
     * Get all of the submission comments.
     */
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable')->latest();
    }

    /**
     * Get the user that owns the submission.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
