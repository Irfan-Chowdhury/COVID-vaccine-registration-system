<?php

namespace App\Http\Controllers;

use App\Models\VaccineCenter;
use App\Services\VaccineCenterService;

class VaccineCenterController extends Controller
{

    private $vaccineCenterService;
    public function __construct(VaccineCenterService $vaccineCenterService){
        $this->vaccineCenterService   = $vaccineCenterService;
    }

    public function index()
    {
        $vaccineCenters = $this->vaccineCenterService->getAllVaccineCenterData();
        return view('pages.vaccine_centers', compact('vaccineCenters'));
    }
}
