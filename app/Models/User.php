<?php

namespace App\Models;

use App\Presenters\UserPresenter;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory;
    use Notifiable;
    use UserPresenter;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'avatar', 'currency', 'email', 'name', 'password', 'stripe_customer_id', 'api_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'laravel_through_key',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the contests for the user.
     */
    public function contests()
    {
        return $this->hasMany(Contest::class);
    }

    /**
     * Get the submissions for the user.
     */
    public function submissions()
    {
        return $this->hasMany(Submission::class);
    }

    /**
     * Get the winnings for the user.
     *
     * @return mixed
     */
    public function winnings()
    {
        $payments = collect([]);

        $this->submissions()->where('winner', true)->with(['contest.payment' => function($q) use (&$payments){
            $payments = $q->get()->unique();
        }])->get();

        return $payments;
    }

    /**
     * Fetch the user payouts.
     */
    public function payouts()
    {
        return $this->hasMany(Payout::class);
    }

    /**
     * The channels the user receives notification broadcasts on.
     *
     * @return string The private channel.
     */
    public function receivesBroadcastNotificationsOn()
    {
        return 'users.' . $this->id;
    }
}
