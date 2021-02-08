<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StripeSessionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('checkout', $this->route('contest'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'amount' => ['required', 'numeric', 'min:5000'],
            'currency' => ['required', 'string'],
            'email' => ['required', 'email'],
            'name' => ['required', 'string'],
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        $amount = number_format($this->amount / 100, 2);

        return [
            'amount.min' => "The amount must be at least $amount $this->currency.",
        ];
    }
}
