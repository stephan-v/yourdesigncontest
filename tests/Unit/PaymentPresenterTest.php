<?php

namespace Tests\Unit;

use App\Contest;
use App\Payment;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Money\Currency;
use Tests\TestCase;

class PaymentPresenterTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * The contest to test the presenter for.
     *
     * @var Contest $contest
     */
    private $contest;

    /**
     * Setup the test environment.
     */
    public function setUp(): void
    {
        parent::setUp();

        app()->singleton(Currency::class, function() {
            return new Currency('USD');
        });

        $user = factory(User::class)->create();

        $contest = factory(Contest::class)->make();
        $contest = $user->contests()->save($contest);

        $contest->payment()->save(
            factory(Payment::class)->make(['amount' => 115000])
        );

        $this->contest = $contest;
    }

    public function test_can_get_correct_payout_attribute()
    {
        // Arrange.
        $contest = $this->contest;

        // Act.
        $payout = $contest->payment->winnings->getAmount();

        // Assert.
        $this->assertEquals($payout, 100000);
    }

    public function test_can_get_correct_formatted_payout_attribute()
    {
        // Arrange.
        $contest = $this->contest;

        // Act.
        $formattedPayout = $contest->payment->formattedPayout;

        // Assert.
        $this->assertEquals($formattedPayout, '$1,150.00');
    }
}
