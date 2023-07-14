<?php

namespace App\Http\Requests;

use Illuminate\Http\Response;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class SignUpFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'firstname' => 'required|alpha',
            'lastname' => 'required|alpha',
            'username' => 'required|unique:users|max:24',
            'email' => 'required|email|unique:users',
            //'avatar' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:max_width=1920,max_height=1080',
            'country' => 'required',
            'password' => 'required|min:6|max:64',
        ];
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     *
     * @throws \Illuminate\Http\Exceptions\HttpResponseException
     */
    protected function failedValidation(Validator $validator)
    {
        $response = [
            'error' => 'Validation failed',
            'message' => $validator->errors()->all(),
        ];

        throw new HttpResponseException(response()->json($response, Response::HTTP_UNPROCESSABLE_ENTITY));
    }
}
