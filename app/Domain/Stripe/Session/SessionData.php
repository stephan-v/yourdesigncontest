<?php

namespace App\Domain\Stripe\Session;

use App\Models\Contest;
use App\Domain\Stripe\LineItems\ContestLineItem;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Facades\Auth;

class SessionData implements Arrayable
{
    /**
     * The contest to create a checkout session for.
     *
     * @var Contest  $contest
     */
    private $contest;

    /**
     * The session data.
     *
     * @var array $data
     */
    private $data;

    /**
     * Initialize a new Stripe Contest line item.
     *
     * @param array $data The session data.
     * @param Contest $contest The contest to create a checkout session for.
     */
    public function __construct(array $data, Contest $contest)
    {
        $this->data = $data;
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
            'mode' => 'payment',
            'payment_method_types' => ['card'],
            'metadata' => [
                'contest_id' => $this->contest->id,
            ],
            'line_items' => [
                (new ContestLineItem($this->data))->toArray(),
            ],
            'success_url' => urldecode(route('checkout.success', ['session_id' => '{CHECKOUT_SESSION_ID}'])),
            'cancel_url' => route('checkout.create'),
        ]);

        $user = Auth::user();

        // Set the customer id if this is a returning customer, only an id OR email may be used since Stripe will
        // automatically do a lookup of the email if you provide the customer id.
        if ($stripe_customer_id = $user->stripe_customer_id) {
            $data->put('customer', $stripe_customer_id);
        } else {
            $data->put('customer_email', $user->email);
        }

        return $data->toArray();
    }
}
