<?php

namespace App\Models;

use App\Presenters\SubmissionPresenter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Submission extends Model
{
    use HasFactory, SoftDeletes, SubmissionPresenter;

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
