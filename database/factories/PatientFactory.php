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
            'uuid'=> fake()->uuid(),
            'name' => fake()->name(),
            'mother_name' => fake()->name('female'),
            'dob' => fake()->date('Y-m-d', $max = 'now'),
            'email' => fake()->unique()->safeEmail(),
            'cpf' => fake()->numerify('###########'),
            'cns' => fake()->numerify('###############'),
            'photo' => '/storage/app/public/users/' . md5(Str::random()) . '.png'
        ];
    }
}
