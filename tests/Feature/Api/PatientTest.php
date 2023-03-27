<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use App\Models\Patient;
use Faker\Factory;
use Illuminate\Support\Str;

class PatientTest extends TestCase
{
    public function test_list_all_patients(): void
    {
        $response = $this->getJson('/patient/list');
        $response->assertStatus(200);
    }

    public function test_get_count_patients(): void
    {
        Patient::factory(20)->create();
        $response = $this->getJson('/patient/list');
        //$response->dump();
        $response->assertJsonCount(10, 'data');
        $response->assertStatus(200);
    }

    public function test_not_found_patients() {
        $response = $this->getJson('/patient/1234567890');
        $response->assertStatus(404);
    }

    public function test_get_patient() {
        $patient = Patient::factory()->create();
        $response = $this->getJson("/patient/{$patient->uuid}");
        $response->assertStatus(200);
    }

    public function test_fail_create_patient() {
        $patient = Patient::factory()->create();
        $response = $this->postJson("/patient", []);
        $response->assertStatus(400);
    }

    public function test_create_patient() {
        $faker = Factory::create();
        $response = $this->postJson("/patient", [
            'uuid'=> $faker->uuid(),
            'name' => $faker->name(),
            'mother_name' => $faker->name('female'),
            'dob' => $faker->date('Y-m-d', $max = 'now'),
            'email' => $faker->safeEmail(),
            'cpf' => $faker->numerify('###########'),
            'cns' => $faker->numerify('###############'),
            'photo' => '/storage/app/public/users/' . md5(Str::random()) . '.png'
        ]);
        $response->assertStatus(201);
    }

    public function test_delete_patient() {
        $patient = Patient::factory()->create();
        $response = $this->deleteJson("/patient/{$patient->uuid}");
        $response->assertStatus(204);
    }

    public function test_update_patient() {
        $patient = Patient::factory()->create();
        $faker = Factory::create();
        $response = $this->putJson("/patient/{$patient->uuid}", [
            'name' => $faker->name()
        ]);
        $response->assertStatus(204);
    }
}
