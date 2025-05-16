<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostFormRequest extends FormRequest
{
    /**
     * Determines if user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Checks that the validation rules apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'body' => 'required'
        ];
    }

    /**
     * Gets an error message for the defined validation rules.
     *
     * @return array
     */
    public function messages() {
        return [
            'body.required' => 'A message is required',
        ];
    }
}
