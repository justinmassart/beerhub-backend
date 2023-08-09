<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBeerFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'brand' => 'required',
            'country' => 'required|alpha',
            'type' => 'required|alpha',
            'color' => 'required|alpha',
            'abv' => 'required',
            'volume_available' => 'array',
            'volume_available.*' => 'string',
            'container_available' => 'array',
            'container_available.*' => 'string',
            'aromas' => 'array',
            'aromas.*' => 'string',
            'ingredients' => 'array',
            'ingredients.*' => 'string',
            'ibu' => 'numeric',
            'is_gluten_free' => 'boolean',
            'is_from_abbey' => 'boolean',
            'non_filtered' => 'boolean',
            'refermented' => 'boolean',
        ];
    }
}
