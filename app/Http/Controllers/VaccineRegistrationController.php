<?php

namespace App\Http\Controllers;

use App\Models\VaccineCenter;
use Illuminate\Http\Request;

class VaccineRegistrationController extends Controller
{
    public function userIdentificationPage()
    {
        return view('pages.vaccine_registration.user_identification_page');
    }


    public function userIdentificationProcess()
    {
        return redirect(route("vaccine-registration.userInformationPage"), 307);
    }

    public function userInformationPage()
    {
        $vaccineCenters = VaccineCenter::get();
        return view('pages.vaccine_registration.user_information_page',compact('vaccineCenters'));
    }

    public function confirmation()
    {
        return view('pages.vaccine_registration.confirmation_page');
    }
}
