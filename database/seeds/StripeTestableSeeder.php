<?php

use App\Contest;
use App\Payment;
use App\Payout;
use App\Submission;
use Illuminate\Database\Seeder;
use Money\Currency;
use Stripe\Account;
use Stripe\Customer;
use Stripe\Exception\ApiErrorException;
use Stripe\PaymentIntent;

/**
 * @TODO remove this out of the default seeder flow when done testing.
 */
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
        // Set the currency because the service is not instantiated in a seeder.
        app()->singleton(Currency::class, function() {
            return new Currency('EUR');
        });

        // Contest which has an actual Stripe payment to test.
        $contest = factory(Contest::class)->create([
            'name' => 'Stripe testable',
            'expires_at'=> now()->addDays(3),
            'user_id' => 1,
        ]);

        // Crate the Stripe customer.
        $customer = Customer::create([
            'email' => $contest->user->email,
        ]);

        // Create a payment intent to mimic a paid contest.
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

        // Create the contest locally with the Stripe payment id.
        $contest->payment()->save(factory(Payment::class)->make([
            'amount' => $paymentIntent['amount'],
            'payment_id' => $paymentIntent->id,
        ]));

        // Create a winning submission for the stripe testable.
        factory(Submission::class)->create([
            'contest_id' => $contest->id,
            'winner' => true,
        ]);
    }
}
