<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'postcode' => ['nullable'],
            'street_address' => ['nullable', 'min:3', 'max:100'],
            'building_number' => ['nullable', 'integer'],
            'street_name' => ['nullable', 'min:3', 'max:100'],
            'city' => ['nullable', 'min:3', 'max:100'],
            'country' => ['nullable', 'min:3', 'max:100'],
        ];
    }
}
