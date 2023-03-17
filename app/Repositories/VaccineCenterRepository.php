<?php

namespace App\Repositories;

use App\Contracts\VaccineCenterContract;
use App\Models\VaccineCenter;

class VaccineCenterRepository implements VaccineCenterContract
{
    public function getAll()
    {
        return VaccineCenter::select('id', 'center_name', 'address', 'single_day_limit')
                            ->get();
    }

    public function get($id)
    {
        return VaccineCenter::find($id);
    }
}
