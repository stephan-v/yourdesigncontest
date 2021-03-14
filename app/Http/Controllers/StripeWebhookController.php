<?php

namespace App\Http\Controllers;

use App\Http\Middleware\VerifyWebhookSignature;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Stripe\BalanceTransaction;
use Stripe\Customer;
use Stripe\Exception\ApiErrorException;
use Stripe\PaymentIntent;
use Symfony\Component\HttpFoundation\Response;

class StripeWebhookController extends Controller
{
    /**
     * Create a new StripeWebhookController instance.
     */
    public function __construct()
    {
        $this->middleware(VerifyWebhookSignature::class);
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
     * Handle a canceled payment intent.
     *
     * @param array $payload The Stripe payload.
     * @return Response The server response.
     */
    private function handlePaymentIntentCanceled(array $payload)
    {
        $stripe = $payload['data']['object'];

        Payment::where('payment_id', $stripe['id'])->update([
            'status' => PaymentIntent::STATUS_CANCELED
        ]);

        return $this->successMethod();
    }

    /**
     * Handle a completed payment intent.
     *
     * @param array $payload The Stripe payload.
     * @return Response The server response.
     * @throws ApiErrorException Thrown if the balance transaction could not be retrieved.
     */
    private function handlePaymentIntentSucceeded(array $payload)
    {
        $stripe = $payload['data']['object'];

        // Fetch the Stripe customer.
        $email = Customer::retrieve($stripe['customer'])->email;
        $user = User::whereEmail($email)->firstOrFail();

        // Update the stripe_customer_id so consecutive payments are linked to the same Stripe user.
        $user->update(['stripe_customer_id' => $stripe['customer']]);

        // Fetch the Stripe incurred fees.
        $transaction = BalanceTransaction::retrieve(
            $stripe['charges']['data'][0]['balance_transaction']
        );

        // Updated the payment with incurred fees.
        Payment::where('payment_id', $stripe['id'])->update([
            'fee' => $transaction->fee,
            'status' => PaymentIntent::STATUS_SUCCEEDED
        ]);

        return $this->successMethod();
    }

    /**
     * Handle successful calls on the controller.
     *
     * @return Response The server response.
     */
    private function successMethod()
    {
        return new Response('Webhook Handled', 200);
    }

    /**
     * Handle calls to missing methods on the controller.
     *
     * @param string $method The missing method.
     * @return Response The server response.
     */
    private function missingMethod(string $method)
    {
        return new Response("Method: '$method' not found");
    }
}
