<?php

namespace Tests\Feature\Api;

use Faker\Factory;
use Tests\TestCase;
use App\Models\Address;
use App\Models\Patient;

class AddressTest extends TestCase
{
    public function test_list_all_addresses(): void
    {
        $address = Address::factory()->create();
        $response = $this->getJson('/patient/address/list');
        $response->assertStatus(204);
    }

    public function test_search_addresses() {
        $address = Address::factory()->create();
        $patient = $address->patient;
        $response = $this->getJson("/patient/{$patient->uuid}/address/search/1234567890");
        $response->assertStatus(404);
    }

    public function test_get_address() {
        $address = Address::factory()->create();
        $patient = $address->patient;
        $response = $this->getJson("/patient/{$patient->uuid}/address");
        $response->assertStatus(200);
    }

    public function test_create_address() {
        $patient = Patient::factory()->create();
        $faker = Factory::create();
        $response = $this->postJson("/patient/{$patient->uuid}/address", [
            'postcode' => $faker->postcode(),
            'street_address' => $faker->streetAddress(),
            'building_number' => $faker->buildingNumber(),
            'street_name' => $faker->streetName(),
            'city' => $faker->city(),
            'country' => $faker->country(),
        ]);
        $response->assertStatus(201);
    }

    public function test_update_address() {
        $address = Address::factory()->create();
        $patient = $address->patient;
        $faker = Factory::create();
        $response = $this->putJson("/patient/{$patient->uuid}/address", [
            'city' => $faker->city()
        ]);
        $response->assertStatus(204);
    }

    public function test_delete_address() {
        $address = Address::factory()->create();
        $patient = $address->patient;
        $response = $this->deleteJson("/patient/{$patient->uuid}/address");
        $response->assertStatus(204);
    }
}
