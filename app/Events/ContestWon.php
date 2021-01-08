<?php

namespace App\Events;

use App\Models\Contest;
use Illuminate\Queue\SerializesModels;

class ContestWon
{
    use SerializesModels;

    /**
     * The contest which has finished with a winner.
     *
     * @var Contest $contest
     */
    public $contest;

    /**
     * Create a new event instance.
     *
     * @param Contest $contest The contest which has finished with a winner.
     */
    public function __construct(Contest $contest)
    {
        $this->contest = $contest->refresh();
    }
}
