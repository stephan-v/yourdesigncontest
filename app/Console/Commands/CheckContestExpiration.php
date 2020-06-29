<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CheckContestExpiration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'contests:check-expiration';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Act upon the expiration date of a contest.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // Send out an email when the contest has only 24 hours to go.

        // Send out an email when the contest has finished to all contest participants.

        // Send out an email to the platform admin (me) when the contest has expired without a winner.

        // In the third case send out an email to the contest owner automatically and keep track of these cases.
    }
}
