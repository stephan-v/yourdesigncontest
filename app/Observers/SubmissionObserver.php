<?php

namespace App\Observers;

use App\Submission;

class SubmissionObserver
{
    /**
     * Handle the submission "creating" event.
     *
     * @param Submission $submission The submission that is being created.
     */
    public function creating(Submission $submission)
    {
        $submission = $submission->contest->submissions->last();

        $order = optional($submission)->order ?? 0;

        $submission->order = ++$order;
    }
}
