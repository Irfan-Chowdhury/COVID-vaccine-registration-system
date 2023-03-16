<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\VaccineCenter;
use App\Trait\DayCheckTrait;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Registration>
 */
class RegistrationFactory extends Factory
{
    use DayCheckTrait;

    public function definition(): array
    {
        $status = fake()->randomElement(['Scheduled', 'Vaccinated', 'Not registered']);

        $user = User::inRandomOrder()->first();

        return [
            'vaccine_center_id' => VaccineCenter::inRandomOrder()->first()->id,
            'nid' => $user->nid,
            'name' => $user->name,
            'gender' => $user->gender,
            'date_of_birth' => $user->date_of_birth,
            'email' => fake()->unique()->safeEmail(),
            'mobile' => fake()->numerify('###########'),
            'schedule_date' => $this->getExpectedDate(),
            'status' => $status,
        ];
    }
}
