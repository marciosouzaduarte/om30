<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Patient>
 */
class PatientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'mother_name' => fake()->name('female'),
            'dob' => fake()->date('Y-m-d', $max = 'now'),
            'cpf' => fake()->numerify('###########'),
            'cns' => fake()->numerify('###############'),
            'complete_address' => $this->getCompleteAddress(),
            'photo' => '/storage/app/public/users/' . md5(Str::random()) . '.png',
            'user_id' => function() {
                return User::factory()->create()->id;
            }
        ];
    }

    private function getCompleteAddress(): string
    {
        return implode(", ", [
            fake()->postcode(),
            fake()->streetAddress(),
            fake()->buildingNumber(),
            fake()->streetName(),
            fake()->postcode(),
            fake()->city(),
            fake()->country(),
        ]);
    }
}
