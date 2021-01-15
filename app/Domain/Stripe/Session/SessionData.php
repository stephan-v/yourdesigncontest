<?php

namespace App\Domain\Stripe\Session;

use App\Models\Contest;
use App\Domain\Stripe\LineItems\ContestLineItem;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;

class SessionData implements Arrayable
{
    /**
     * The contest to create a checkout session for.
     *
     * @var Contest  $contest
     */
    private $contest;

    /**
     * The incoming server request.
     *
     * @var Request $request
     */
    private $request;

    /**
     * Initialize a new Stripe Contest line item.
     *
     * @param Request $request The incoming server request.
     * @param Contest $contest The contest to create a checkout session for.
     */
    public function __construct(Request $request, Contest $contest)
    {
        $this->request = $request;
        $this->contest = $contest;
    }

    /**
     * Cast to array.
     *
     * @return array The line item data.
     */
    public function toArray()
    {
        $data = collect([
            'payment_method_types' => ['card'],
            'payment_intent_data' => [
                'metadata' => [
                    'contest_id' => $this->contest->id,
                ]
            ],
            'line_items' => [
                (new ContestLineItem($this->request))->toArray(),
            ],
            'success_url' => config('app.url') . '/success?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => config('app.url') . '/cancel',
        ]);

        // If present for an existing customer use the Stripe customer id.
        // Otherwise default to an email for customer reference.
        if ($stripe_customer_id = $this->request->user()->stripe_customer_id) {
            $data->put('customer', $stripe_customer_id);
        } else {
            $data->put('customer_email', $this->request->email);
        }

        return $data->toArray();
    }
}
