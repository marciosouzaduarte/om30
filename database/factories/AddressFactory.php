<?php

namespace Database\Factories;

use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
{
    public function definition(): array
    {
        return [
            'patient_id' => Patient::factory(),
            'postcode' => fake()->postcode(),
            'street_address' => fake()->streetAddress(),
            'building_number' => fake()->buildingNumber(),
            'street_name' => fake()->streetName(),
            'city' => fake()->city(),
            'country' => fake()->country(),
        ];
    }
}
