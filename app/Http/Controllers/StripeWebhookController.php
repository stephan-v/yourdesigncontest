<?php

namespace App\Http\Controllers;

use App\Http\Middleware\VerifyWebhookSignature;
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

        return $this->missingMethod();
    }

    /**
     * Handle completed checkout sessions.
     *
     * @param array $payload The Stripe payload.
     * @return Response The server response.
     */
    public function handleCheckoutSessionCompleted(array $payload)
    {
        // Set the contest amount (winning price money).
        // Set the contest live.
        // Send out email receipt.

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
     * @return Response The server response.
     */
    protected function missingMethod()
    {
        return new Response;
    }
}
