<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContestWinner extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * The data available to the markdown email template.
     *
     * @var array $data
     */
    public $data;

    /**
     * Create a new message instance.
     *
     * @param array $data The data used in the markdown template.
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->from(config('mail.from.address'))
            ->markdown('mail.winner');
    }
}
