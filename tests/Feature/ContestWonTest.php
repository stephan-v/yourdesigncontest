<?php

namespace Tests\Feature;

use App\Models\Contest;
use App\Events\ContestWon;
use App\Notifications\ContestFinished;
use App\Notifications\ContestWon as ContestWonNotification;
use App\Models\Payment;
use App\Models\Submission;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class ContestWonTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * Setup the test environment.
     */
    public function setUp(): void
    {
        parent::setUp();

        app()->singleton(\Money\Currency::class, function () {
            return new \Money\Currency('USD');
        });
    }

    public function test_notifications_are_sent_after_contest_win()
    {
        Notification::fake();

        // Arrange.
        $owner = User::factory()->create();
        $designer = User::factory()->create();
        $contestants = User::factory()->count(2)->create();

        $contest = $owner->contests()->save(Contest::factory()->make());

        $contest->payment()->save(
            Payment::factory()->make(['amount' => 115000])
        );

        $submission = $contest->submissions()->save(
            Submission::factory()->make(['user_id' => $designer->id])
        );

        foreach ($contestants as $contestant) {
            $contest->submissions()->save(
                Submission::factory()->make(['user_id' => $contestant->id])
            );
        }

        $submission->update(['winner' => true]);

        // Act.
        event(new ContestWon($contest));

        // Assert.
        Notification::assertSentTo($designer, ContestWonNotification::class);
        Notification::assertSentTo($contestants, ContestFinished::class);
    }
}
