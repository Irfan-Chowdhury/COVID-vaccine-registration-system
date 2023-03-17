<?php

namespace App\Http\Controllers;

use App\Services\RegistrationService;
use App\Traits\DayCheckTrait;
use Illuminate\Http\Request;

class VaccineRegistrationController extends Controller
{
    use DayCheckTrait;

    private $registrationService;

    public function __construct(RegistrationService $registrationService)
    {
        $this->registrationService = $registrationService;
    }

    public function userIdentificationPage()
    {
        return view('pages.vaccine_registration.user_identification_page');
    }

    public function userIdentificationProcess(Request $request)
    {
        if ($this->registrationService->validationForUserIdentification($request) !== 0) {
            return $this->registrationService->validationForUserIdentification($request);
        }

        return redirect(route('vaccine-registration.userInformationPage'), 307);
    }

    public function userInformationPage(Request $request)
    {
        $vaccineCenters = $this->registrationService->getAllVaccineCenterData();
        $user = $this->registrationService->getUserInformation($request);

        return view('pages.vaccine_registration.user_information_page', compact('vaccineCenters', 'user'));
    }

    public function confirmationPage(Request $request)
    {
        if ($this->registrationService->validationForConfirmationPage($request) !== 0) {
            return $this->registrationService->validationForConfirmationPage($request);
        }
        $otp = $this->registrationService->generateOTPAndSendMail($request);

        return view('pages.vaccine_registration.confirmation_page', compact('otp', 'request'));
    }

    public function confirmationProcess(Request $request)
    {
        if ($this->registrationService->validationDuringFinalConfirmationProcess($request) !== 0) {
            return $this->registrationService->validationDuringFinalConfirmationProcess($request);
        }
        $this->registrationService->processingForConfirmation($request);

        return view('pages.vaccine_registration.success');
    }
}
