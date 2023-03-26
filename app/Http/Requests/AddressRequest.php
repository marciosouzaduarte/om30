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
            'postcode' => ['required'],
            'street_address' => ['required', 'min:3', 'max:100'],
            'building_number' => ['required', 'integer'],
            'street_name' => ['required', 'min:3', 'max:100'],
            'city' => ['required', 'min:3', 'max:100'],
            'country' => ['required', 'min:3', 'max:100'],
        ];
    }
}