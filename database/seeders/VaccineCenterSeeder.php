<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\VaccineCenter;

class VaccineCenterSeeder extends Seeder
{

    public function run(): void
    {
        VaccineCenter::factory()
                    ->count(10)
                    ->create();
    }
}
