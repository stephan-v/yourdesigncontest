<?php

namespace Tests\Feature;

use App\Contest;
use App\Payment;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ViewHandoverTest extends TestCase
{
    use DatabaseMigrations;

    public function test_owner_can_view_handover()
    {
        // Arrange
        $owner = factory(User::class)->create();
        $designer = factory(User::class)->create();

        $contest = $this->createPaidContest($owner);
        $this->createWinningContestSubmission($contest, $designer);

        // Act.
        $this->actingAs($owner);
        $response = $this->get('/contests/' . $contest->id . '/files');

        // Assert.
        $response->assertOk();
    }

    public function test_designer_can_view_handover()
    {
        // Arrange
        $owner = factory(User::class)->create();
        $designer = factory(User::class)->create();

        $contest = $this->createPaidContest($owner);
        $this->createWinningContestSubmission($contest, $designer);

        // Act.
        $this->actingAs($designer);
        $response = $this->get('/contests/' . $contest->id . '/files');

        // Assert.
        $response->assertOk();
    }

    public function test_outsider_cannot_view_handover()
    {
        // Arrange
        $owner = factory(User::class)->create();
        $designer = factory(User::class)->create();
        $visitor = factory(User::class)->create();

        $contest = $this->createPaidContest($owner);
        $this->createWinningContestSubmission($contest, $designer);

        // Act.
        $this->actingAs($visitor);
        $response = $this->get('/contests/' . $contest->id . '/files');

        // Assert.
        $response->assertForbidden();
    }

    /**
     * Create a contest with a payment.
     *
     * @param User $user The user which creates the contest.
     * @return false|Contest The created contest.
     */
    private function createPaidContest(User $user): Contest
    {
        $contest = $user->contests()->save(
            factory(Contest::class)->make()
        );

        $contest->payment()->save(
            factory(Payment::class)->make()
        );

        return $contest;
    }
}
