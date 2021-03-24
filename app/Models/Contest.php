<?php

namespace App\Models;

use App\Presenters\ContestPresenter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Contest extends Model
{
    use ContestPresenter;
    use HasFactory;
    use HasSlug;

    /**
     * The attributes that are mass assignable.
     *
     * @var array $fillable
     */
    protected $fillable = [
        'category',
        'description',
        'expires_at',
        'title',
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
     * Get the user that owns the contest.
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

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()->generateSlugsFrom('title')->saveSlugsTo('slug');
    }

    /**
     * Get the route key for the model.
     *
     * @return string The route key name.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
