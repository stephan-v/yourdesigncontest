<?php

namespace Tests\Unit;

use App\Contest;
use App\Payment;
use App\User;
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

        $user = factory(User::class)->create();
        $contestA = factory(Contest::class)->create();
        $contestB = factory(Contest::class)->create();

        $amountA = 300000;
        $amountB = 500000;

        // Create 2 contest with winning submissions.
        $contestA->payment()->save(factory(Payment::class)->make([
            'amount' => $amountA,
            'currency' => 'USD',
        ]));

        $contestB->payment()->save(factory(Payment::class)->make([
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
