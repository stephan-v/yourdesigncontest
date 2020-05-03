<?php

use App\Contest;
use App\Payment;
use App\Payout;
use App\Submission;
use Illuminate\Database\Seeder;
use Stripe\Customer;
use Stripe\Exception\ApiErrorException;
use Stripe\PaymentIntent;

class StripeTestableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws ApiErrorException Thrown if there is a Stripe API error.
     */
    public function run()
    {
        // Contest which has an actual Stripe payment to test.
        $contest = factory(Contest::class)->create([
            'name' => 'Stripe testable',
            'expires_at'=> now()->addDays(3),
            'user_id' => 1,
        ]);

        $customer = Customer::create([
            'email' => $contest->user->email,
        ]);

        $paymentIntent = PaymentIntent::create([
            'amount' => 2000,
            'currency' => 'eur',
            'payment_method' => 'pm_card_bypassPending',
            'confirm' => true,
            'customer' => $customer->id,
            'metadata' => [
                'contest_id' => $contest->id,
            ]
        ]);

        $contest->payment()->save(factory(Payment::class)->make([
            'payment_id' => $paymentIntent->id,
        ]));

        // Create a winning submission for the stripe testable.
        factory(Submission::class)->create([
            'contest_id' => $contest->id,
            'winner' => true,
        ]);

        // Create the pending payout.
        factory(Payout::class)->create([
            'contest_id' => $contest->id,
            'user_id' => $contest->user->id,
        ]);
    }
}
