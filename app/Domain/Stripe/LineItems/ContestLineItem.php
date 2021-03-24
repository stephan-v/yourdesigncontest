<?php

namespace App\Domain\Stripe\LineItems;

use Illuminate\Contracts\Support\Arrayable;

class ContestLineItem implements Arrayable
{
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
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Cast to array.
     *
     * @return array The line item data.
     */
    public function toArray()
    {
        return [
            'name' => $this->data['title'],
            'description' => 'Design contest',
            'images' => null,
            'amount' => $this->data['amount'],
            'currency' => $this->data['currency'],
            'quantity' => 1,
        ];
    }
}
