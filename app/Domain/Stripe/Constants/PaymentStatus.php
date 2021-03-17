<?php

namespace App\Domain\Stripe\Constants;

class PaymentStatus
{
    /**
     * The payment was canceled, this could be due to duplication, fraud, etc.
     */
    const CANCELED = 'canceled';

    /**
     * The payment was created which is the initial payment intent status.
     */
    const CREATED = 'created';

    /**
     * The payment failed due to an error when processing the payment.
     */
    const FAILED = 'failed';

    /**
     * The payment requires additional action such a authenticating with 3D Secure.
     */
    const REQUIRES_ACTION = 'requires action';

    /**
     * The payment succeeded and the order can be fulfilled.
     */
    const SUCCEEDED = 'succeeded';
}
