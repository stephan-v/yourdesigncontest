<?php

namespace App\Http\Controllers;

use App\Contest;
use App\Http\Middleware\VerifyWebhookSignature;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
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
     */
    public function handlePaymentIntentSucceeded(array $payload)
    {
        // Set the contest live.
        // Send out email receipt.

        $amount = $payload['data']['object']['amount'];
        $contestId = $payload['data']['object']['metadata']['contest_id'];
        $currency = $payload['data']['object']['currency'];
        $paymentId = $payload['data']['object']['id'];

        Contest::findOrFail($contestId)->transaction()->create([
            'amount' => $amount,
            'currency' => strtoupper($currency),
            'payment_id' => $paymentId
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
