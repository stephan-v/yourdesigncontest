<?php

namespace App\Domain\Stripe\LineItems;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;

class ContestLineItem implements Arrayable
{
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
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Cast to array.
     *
     * @return array The line item data.
     */
    public function toArray()
    {
        return [
            'name' => $this->request->name,
            'description' => 'Design contest',
            'images' => null,
            'amount' => $this->request->amount,
            'currency' => $this->request->currency,
            'quantity' => 1,
        ];
    }
}
