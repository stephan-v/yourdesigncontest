<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ContestSubmissionRequest extends FormRequest
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
     * Prepare the data for validation.
     */
    public function prepareForValidation()
    {
        $this->merge(['crop' => explode(',', $this->crop)]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'crop' => ['required', 'array'],
            'description' => ['nullable', 'string'],
            'image' => ['required', 'file', 'image', 'max:1000'],
            'terms' => ['required', 'accepted'],
            'title' => ['required', 'string'],
        ];
    }
}
