<?php

namespace Tests;

use App\Models\Contest;
use App\Models\Submission;
use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * Create a contest submission.
     *
     * @param Contest $contest The contest to create a submission for.
     * @param User $user The user that creates a submission.
     * @return false|Submission The created submission.
     */
    protected function createWinningContestSubmission(Contest $contest, User $user): Submission
    {
        return $contest->submissions()->save(
            Submission::factory()->make([
                'user_id' => $user->id,
                'winner' => true,
            ])
        );
    }
}
