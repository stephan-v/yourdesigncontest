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
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'amount' => ['required', 'numeric', 'min:25'],
            'contest_id' => ['required', 'exists:contests,id'],
            'email' => ['required', 'email'],
            'name' => ['required', 'string'],
        ];
    }
}