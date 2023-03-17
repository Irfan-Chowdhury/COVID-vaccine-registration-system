<?php

namespace App\Http\Controllers;

use App\Mail\OTPMail;
use App\Mail\RegistrationSuccessfulMail;
use App\Models\Registration;
use App\Models\User;
use App\Models\VaccineCenter;
use App\Traits\DayCheckTrait;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class VaccineRegistrationController extends Controller
{
    use DayCheckTrait;

    public function userIdentificationPage()
    {
        return view('pages.vaccine_registration.user_identification_page');
    }

    public function userIdentificationProcess(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nid' => 'required|numeric|unique:registrations',
            'date_of_birth' => 'required',
        ],
            [
                'nid.unique' => 'Already registered according to this NID',
            ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Fetch Verified Users Data
        // $response = Http::get('https://jsonplaceholder.typicode.com/users');
        // return $response->json();
        //url(/);

        $isAuthenticUser = User::where('nid', $request->nid)
                            ->where('date_of_birth', $request->date_of_birth);

        if (! $isAuthenticUser->exists()) {
            $this->setErrorMessage('Your NID or Date of birth does not verify.');

            return redirect()->back();
        }

        return redirect(route('vaccine-registration.userInformationPage'), 307);
    }

    public function userInformationPage(Request $request)
    {
        $user = User::where('nid', $request->nid)
                            ->where('date_of_birth', $request->date_of_birth)
                            ->first();

        $vaccineCenters = VaccineCenter::select('id', 'center_name')->get();

        return view('pages.vaccine_registration.user_information_page', compact('vaccineCenters', 'user'));
    }

    public function confirmationPage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile' => 'required|numeric',
            'email' => 'required|email',
            'vaccine_center_id' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect(route('vaccine-registration.confirmationPage'), 307)->withErrors($validator)->withInput();
        }

        $otp = rand(100000, 999999);

        Mail::to($request->email)
        ->send(new OTPMail($otp));

        return view('pages.vaccine_registration.confirmation_page', compact('otp', 'request'));
    }

    public function confirmationProcess(Request $request)
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

        // Business Logic
        $currentDate = new DateTime();
        $expectedDate = $currentDate->modify('+7 days')->format('Y-m-d');
        $vaccineCenterDailyCapacity = VaccineCenter::find($request->vaccine_center_id)->single_day_limit;
        $totalRegCountDateAndCenterWise = Registration::where('vaccine_center_id', $request->vaccine_center_id)
                                        ->where('schedule_date', $expectedDate)
                                        ->count();

        if ($totalRegCountDateAndCenterWise < $vaccineCenterDailyCapacity) {
            $confirmDate = $this->getExpectedDate($currentDate);
        }
        // else if($totalRegCountDateAndCenterWise === $vaccineCenterDailyCapacity) {}

        Registration::create([
            'vaccine_center_id' => $request->vaccine_center_id,
            'nid' => $request->nid,
            'name' => $request->name,
            'gender' => $request->gender,
            'date_of_birth' => $request->date_of_birth,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'schedule_date' => $confirmDate,
            'status' => 'Scheduled',
        ]);

        Mail::to($request->email)
        ->send(new RegistrationSuccessfulMail($request->name, $confirmDate));

        return view('pages.vaccine_registration.success');
    }
}
