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

        // Create a connect account.
        $account = Account::create([
            'country' => 'NL',
            'business_type' => 'individual',
            'type' => 'custom',
            'requested_capabilities' => [
                'card_payments',
                'transfers',
            ],
            'tos_acceptance' => [
                'date' => time(),
                'ip' => '8.8.8.8'
            ],
            'business_profile' => [
                'url' => 'https:/test-stripe-implementation.com',
                'mcc' => '5045',
            ],
            'individual' => [
                'address' => [
                    'city' => 'Schenectady',
                    'line1' => '123 State St',
                    'postal_code' => '1000AB',
                    'state' => 'NY',
                    'country' => 'NL',
                ],
                'first_name' => 'Stripe',
                'last_name' => 'Test',
                'dob' => [
                    'day' => '1',
                    'month' => '1',
                    'year' => '1980',
                ],
                'phone' => '8888675309',
                'email' => 'user@test-stripe-implementation.com',
            ]
        ]);

        // Update the local database user with the newly created connect account id.
        $contest->user()->update([
           'stripe_connect_id' => $account['id']
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

        // Create the pending payout.
        factory(Payout::class)->create([
            'amount' => $contest->payment->winnings->getAmount(),
            'contest_id' => $contest->id,
            'user_id' => $contest->user->id,
        ]);
    }
}
