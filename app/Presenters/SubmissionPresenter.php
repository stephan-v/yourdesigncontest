<?php

namespace App\Presenters;

trait SubmissionPresenter
{
    /**
     * Get the submission's full image path.
     *
     * @return string The image path of the submission.
     */
    public function getPathAttribute(): string
    {
        return asset("contests/{$this->contest->id}/submissions/{$this->filename}");
    }
}
