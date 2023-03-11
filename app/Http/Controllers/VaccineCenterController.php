<?php

namespace App\Http\Controllers;

use App\Models\VaccineCenter;
use Illuminate\Http\Request;

class VaccineCenterController extends Controller
{
    public function index()
    {
        $vaccineCenters = VaccineCenter::get();

        return view('pages.vaccine_centers',compact('vaccineCenters'));
    }
}
