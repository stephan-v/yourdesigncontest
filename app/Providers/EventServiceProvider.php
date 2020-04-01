<?php

namespace App\Providers;

use App\Events\ContestWon;
use App\Events\ContestPayout;
use App\Listeners\NotifyContestants;
use App\Listeners\NotifyWinner;
use App\Listeners\PayoutToBankAccount;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        ContestWon::class => [
            NotifyWinner::class,
            NotifyContestants::class,
        ],

        ContestPayout::class => [
            PayoutToBankAccount::class,
            // @TODO notify the user that a payout has been made to his account with instructions.
        ],

        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }
}
