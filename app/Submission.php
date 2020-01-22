<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array $fillable
     */
    protected $fillable = [
        'description',
        'path',
        'rating',
        'user_id',
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
        return $this->morphMany(Comment::class, 'commentable')->orderByDesc('created_at');
    }

    /**
     * Get the winner record associated with the submission.
     */
    public function winner()
    {
        return $this->hasOne(Winner::class);
    }

    /**
     * Get the user that owns the submission.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
