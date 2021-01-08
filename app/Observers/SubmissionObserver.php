<?php

namespace App\Observers;

use App\Models\Submission;

class SubmissionObserver
{
    /**
     * Handle the submission "creating" event.
     *
     * @param Submission $submission The submission that is being created.
     */
    public function creating(Submission $submission)
    {
        $latestSubmission = $submission->contest->submissions->last();

        $order = optional($latestSubmission)->order ?? 0;

        $submission->order = ++$order;
    }
}
