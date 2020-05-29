<?php

namespace App\Http\Controllers;

use App\Contest;
use App\Http\Middleware\VerifyWebhookSignature;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Stripe\BalanceTransaction;
use Stripe\Exception\ApiErrorException;
use Symfony\Component\HttpFoundation\Response;

class StripeWebhookController extends Controller
{
    /**
     * Create a new StripeWebhookController instance.
     */
    public function __construct()
    {
        if (config('services.stripe.webhook.secret')) {
            $this->middleware(VerifyWebhookSignature::class);
        }
    }

    /**
     * Handle a Stripe webhook call.
     *
     * @param Request $request The incoming HTTP client request.
     * @return Response The server response.
     */
    public function handleWebhook(Request $request)
    {
        $payload = json_decode($request->getContent(), true);
        $method = 'handle'.Str::studly(str_replace('.', '_', $payload['type']));

        if (method_exists($this, $method)) {
            return $this->{$method}($payload);
        }

        return $this->missingMethod($method);
    }

    /**
     * Handle a completed payment intent.
     *
     * @param array $payload The Stripe payload.
     * @return Response The server response.
     * @throws ApiErrorException Thrown if the balance transaction could not be retrieved.
     */
    public function handlePaymentIntentSucceeded(array $payload)
    {
        // @TODO Send out email receipt.

        $stripe = $payload['data']['object'];

        $amount = $stripe['amount'];
        $contestId = $stripe['metadata']['contest_id'];
        $currency = $stripe['currency'];
        $customer = $stripe['customer'];
        $paymentId = $stripe['id'];

        // Fetch the contest.
        $contest = Contest::findOrFail($contestId);

        // Update the stripe_customer_id so consecutive payments are linked to the same Stripe user.
        $contest->user->update(['stripe_customer_id' => $customer]);

        // Fetch the Stripe incurred fees.
        $transactionId = $stripe['charges']['data'][0]['balance_transaction'];
        $transaction = BalanceTransaction::retrieve($transactionId);

        $contest->payment()->create([
            'amount' => $amount,
            'fee' => $transaction->fee,
            'currency' => $currency,
            'payment_id' => $paymentId,
            'user_id' => $contest->user->id,
        ]);

        return $this->successMethod();
    }

    /**
     * Handle successful calls on the controller.
     *
     * @return Response The server response.
     */
    protected function successMethod()
    {
        return new Response('Webhook Handled', 200);
    }

    /**
     * Handle calls to missing methods on the controller.
     *
     * @param string $method The missing method.
     * @return Response The server response.
     */
    protected function missingMethod(string $method)
    {
        return new Response("Method: '$method' not found");
    }
}
