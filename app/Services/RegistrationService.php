<?php

namespace App\Services;

use App\Contracts\RegistrationContract;
use App\Contracts\UserContract;
use App\Contracts\VaccineCenterContract;
use App\Mail\OTPMail;
use App\Mail\RegistrationSuccessfulMail;
use App\Traits\DayCheckTrait;
use App\Traits\MessageTrait;
use DateTime;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class RegistrationService
{
    use MessageTrait;
    use DayCheckTrait;

    private $registrationContract;

    private $userContract;

    private $vaccineCenterContract;

    public function __construct(RegistrationContract $registrationContract, UserContract $userContract, VaccineCenterContract $vaccineCenterContract)
    {
        $this->registrationContract = $registrationContract;
        $this->userContract = $userContract;
        $this->vaccineCenterContract = $vaccineCenterContract;
    }

    public function validationForUserIdentification($request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'nid' => 'required|numeric|unique:registrations',
                'date_of_birth' => 'required',
            ],
            [
                'nid.unique' => 'Already registered according to this NID',
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Fetch Verified Users Data
        // $response = Http::get('https://jsonplaceholder.typicode.com/users');
        // return $response->json();   //url(/);

        $isAuthenticUser = $this->userContract->checkExists($request->nid, $request->date_of_birth);
        if (! $isAuthenticUser) {
            $this->setErrorMessage('Your NID or Date of birth does not verify.');

            return redirect()->back();
        }

        return 0;
    }

    public function getAllVaccineCenterData()
    {
        return $this->vaccineCenterContract->getAll();
    }

    // Should API
    public function getUserInformation($request)
    {
        return $this->userContract->getUserInfo($request->nid, $request->date_of_birth);
    }

    public function validationForConfirmationPage($request)
    {
        $validator = Validator::make($request->all(), [
            'mobile' => 'required|numeric',
            'email' => 'required|email',
            'vaccine_center_id' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect(route('vaccine-registration.confirmationPage'), 307)->withErrors($validator)->withInput();
        }

        return 0;
    }

    public function generateOTPAndSendMail($request)
    {
        $otp = rand(100000, 999999);

        // dispatch(Mail::to($request->email)
        // ->send(new OTPMail($otp)));
        
        Mail::to($request->email)
        ->send(new OTPMail($otp));

        return $otp;
    }

    public function validationDuringFinalConfirmationProcess($request)
    {
        // Validation
        $validator = Validator::make($request->all(), [
            'user_otp' => 'required|numeric|digits:6',
        ]);
        if ($validator->fails()) {
            return redirect(route('vaccine-registration.confirmationPage'), 307)->withErrors($validator)->withInput();
        }

        if ($request->system_otp !== $request->user_otp) {
            $this->setErrorMessage('OTP does not match. Please input correct OTP.');

            return redirect(route('vaccine-registration.confirmationPage'), 307);
        }

        return 0;
    }

    public function processingForConfirmation($request)
    {
        $confirmDate = $this->getConfirmDate($request);
        $this->registrationContract->store($request, $confirmDate);

        Mail::to($request->email)
        ->send(new RegistrationSuccessfulMail($request->name, $confirmDate));
    }

    protected function getConfirmDate($request)
    {
        $currentDate = new DateTime();
        $expectedDate = $currentDate->modify('+7 days')->format('Y-m-d');
        $vaccineCenterDailyCapacity = $this->vaccineCenterContract->get($request->vaccine_center_id)->single_day_limit;
        $totalRegCountDateAndCenterWise = $this->registrationContract->count($request->vaccine_center_id, $expectedDate);

        if ($totalRegCountDateAndCenterWise < $vaccineCenterDailyCapacity) {
            $confirmDate = $this->getExpectedDate($currentDate);
        }

        return $confirmDate;
    }
}
