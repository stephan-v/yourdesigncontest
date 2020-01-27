<?php

namespace App\Mail;

use App\Contest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContestWinner extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * The contest data available to the markdown email template.
     *
     * @var Contest $contest
     */
    public $contest;

    /**
     * Create a new message instance.
     *
     * @param Contest $contest The contest data used in the markdown template.
     */
    public function __construct(Contest $contest)
    {
        $this->contest = $contest;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail.contest.winner');
    }
}
