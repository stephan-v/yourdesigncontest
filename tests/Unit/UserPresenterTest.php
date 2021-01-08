<?php

namespace Tests\Unit;

use App\Models\Contest;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Money\Currency;
use Tests\TestCase;

class UserPresenterTest extends TestCase
{
    use DatabaseMigrations;

    public function test_can_calculate_total_pending_payout_correctly()
    {
        // Arrange.
        app()->singleton(Currency::class, function() {
            return new Currency('USD');
        });

        $user = User::factory()->create();
        $contestA = Contest::factory()->create();
        $contestB = Contest::factory()->create();

        $amountA = 300000;
        $amountB = 500000;

        // Create 2 contest with winning submissions.
        $contestA->payment()->save(Payment::factory()->make([
            'amount' => $amountA,
            'currency' => 'USD',
        ]));

        $contestB->payment()->save(Payment::factory()->make([
            'amount' => $amountB,
            'currency' => 'USD',
        ]));

        $this->createWinningContestSubmission($contestA, $user);
        $this->createWinningContestSubmission($contestB, $user);

        // Act.
        $total = $user->totalPayoutAmount->getAmount();

        // Assert.
        $paymentA = new Payment([
            'amount' => $amountA,
            'currency' => 'USD',
        ]);

        $paymentB = new Payment([
            'amount' => $amountB,
            'currency' => 'USD',
        ]);

        $expected = $paymentA->winnings->getAmount() + $paymentB->winnings->getAmount();

        $this->assertEquals($expected, $total);
    }
}
