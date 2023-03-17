<?php

namespace App\Services;

use App\Contracts\VaccineCenterContract;

class VaccineCenterService
{
    private $vaccineCenterContract;

    public function __construct(VaccineCenterContract $vaccineCenterContract)
    {
        $this->vaccineCenterContract = $vaccineCenterContract;
    }

    public function getAllVaccineCenterData()
    {
        return $this->vaccineCenterContract->getAll();
    }
}
