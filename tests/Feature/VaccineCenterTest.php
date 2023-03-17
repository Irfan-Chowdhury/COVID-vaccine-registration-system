<?php

namespace Tests\Feature;

use App\Models\VaccineCenter;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class VaccineCenterTest extends TestCase
{

    public function test_to_check_vaccine_center_url(): void
    {
        $response = $this->get('/vaccine-centers');
        $response->assertStatus(200);
    }

    public function test_to_check_vaccine_center_data_exists(): void
    {
        $results = VaccineCenter::get();
        $this->assertNotEmpty($results);
    }
}
