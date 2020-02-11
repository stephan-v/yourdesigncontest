<?php

namespace App\Presenters;

trait SubmissionPresenter
{
    /**
     * Get the submission's path.
     *
     * @param string $value The original value.
     * @return string The image path of the submission.
     */
    public function getPathAttribute(string $value): string
    {
        return asset($value);
    }
}
