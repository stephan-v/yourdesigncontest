<?php

namespace Tests\Feature;

use App\Contest;
use App\Payment;
use App\Submission;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class MakePayoutTest extends TestCase
{
    use DatabaseMigrations;

    public function test_payout_without_connect_account_should_fail()
    {
        // Arrange
        $owner = factory(User::class)->create();
        $designer = factory(User::class)->create();

        $contest = $owner->contests()->save(
            factory(Contest::class)->make()
        );

        $contest->payment()->save(
            factory(Payment::class)->make()
        );

        $submission = $contest->submissions()->save(
            factory(Submission::class)->make(['user_id' => $designer->id])
        );

        $submission->update(['winner' => true]);

        // Act.
        $this->actingAs($owner);

        $response = $this->get('/contests/' . $contest->id . '/payout');
    }
}
