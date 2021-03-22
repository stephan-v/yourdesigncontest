<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class StripeSessionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
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
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        // @TODO Calculate the amount dynamically.
        return [
            'amount.min' => 'The amount must be at least 50 ' . Str::upper($this->currency) . '.',
        ];
    }
}
