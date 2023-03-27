<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PatientRequest extends FormRequest
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
            'name' => ['nullable', 'min:3', 'max:50'],
            'mother_name' => ['nullable', 'min:3', 'max:50'],
            'dob' => ['nullable'],
            'email' => ['nullable', 'email'],
            'cpf' => ['nullable', 'integer'],
            'cns' => ['nullable', 'integer'],
            'postcode' => [''],
            'street_address' => ['min:3', 'max:100'],
            'building_number' => ['integer'],
            'street_name' => ['min:3', 'max:100'],
            'city' => ['min:3', 'max:100'],
            'country' => ['min:3', 'max:100'],
        ];
    }
}
