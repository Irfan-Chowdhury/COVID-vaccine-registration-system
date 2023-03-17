<?php

namespace Tests\Feature;

use App\Providers\RouteServiceProvider;
use App\Traits\DayCheckTrait;
use DateTime;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    // use RefreshDatabase;
    use DayCheckTrait;

    public function test_schedule_date_except_friday():void
    {
        /*Let current date is - 2023-03-17 (Friday)
        | As per our system, date difference 7 days from the during registration created date
        | Then $expectedDate is - 2023-03-26 (Sunday)
        */
        $currentDate = new DateTime('2023-03-17');
        $expectedDate = $this->getExpectedDate($currentDate);
        $this->assertStringContainsString('2023-03-26', $expectedDate);
    }

    public function test_schedule_date_except_saturday():void
    {
        /*Let current date is - 2023-03-18 (Saturday)
        | As per our system, date difference 7 days from the during registration created date
        | Then $expectedDate is - 2023-03-26 (Sunday)
        */
        $currentDate = new DateTime('2023-03-18');
        $expectedDate = $this->getExpectedDate($currentDate);
        $this->assertStringContainsString('2023-03-26', $expectedDate);
    }

    public function test_schedule_date_within_sunday_to_thursday():void
    {
        /*Let current date is - 2023-03-19 (Sunday)
        | As per our system, date difference 7 days from the during registration created date
        | Then $expectedDate is - 2023-03-26 (Sunday)
        */
        $currentDate = new DateTime('2023-03-19');
        $expectedDate = $this->getExpectedDate($currentDate);
        $this->assertStringContainsString('2023-03-26', $expectedDate);
    }

    public function test_schedule_date_on_thursday():void
    {
        /*Let current date is - 2023-03-23 (Thursday)
        | As per our system, date difference 7 days from the during registration created date
        | Then $expectedDate is - 2023-03-30 (Thursday)
        */
        $currentDate = new DateTime('2023-03-23');
        $expectedDate = $this->getExpectedDate($currentDate);
        $this->assertStringContainsString('2023-03-30', $expectedDate);
    }

    // public function test_new_users_can_register()
    // {
    //     $response = $this->post('/test', [
    //         'center_name' => 'XYZ',
    //         'single_day_limit' => 20,
    //     ]);
    //     $response->assertStatus(200);
    // }
}

// php artisan test --filter RegistrationTest
