<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Exception;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ContestRequest extends FormRequest
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
            'description' => ['required', 'string'],
            'expires_at' => ['required', 'digits_between:1,4'],
            'name' => ['required', 'string'],
        ];
    }

    /**
     * Override this method to modify request data AFTER it's validated.
     *
     * @return array The modified array of validated data.
     * @throws Exception Emits Exception in case of an error.
     */
    public function validated()
    {
        $data = $this->validator->validated();

        $data['expires_at'] = (new Carbon())->addWeeks($data['expires_at']);

        return $data;
    }
}