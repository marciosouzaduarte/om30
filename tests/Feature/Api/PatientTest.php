<?php

namespace Tests\Feature\Api;

use App\Models\Patient;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PatientTest extends TestCase
{
    public function test_list_all_patients(): void
    {
        $response = $this->getJson('/patient/list');

        $response->assertStatus(200);
    }

    public function test_get_count_patients(): void
    {
        Patient::factory(10)->create();

        $response = $this->getJson('/patient/list/1');

        //$response->dump();
        $response->assertJsonCount(10, 'data');
        $response->assertStatus(200);
    }
}
