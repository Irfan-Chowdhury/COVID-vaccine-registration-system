<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\VaccineCenter;
use Illuminate\Http\Request;
use Automattic\WooCommerce\Client as WoClient;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;

class VaccineRegistrationController extends Controller
{
    public function userIdentificationPage()
    {

        return view('pages.vaccine_registration.user_identification_page');
    }


    public function userIdentificationProcess(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'nid' => 'required|numeric',
            'date_of_birth'  => 'required'
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Fetch Verified Users Data
        // $response = Http::get('https://jsonplaceholder.typicode.com/users');
        // return $response->json();
        //url(/);

        $isAuthenticUser = User::where('nid',$request->nid)
                            ->where('date_of_birth',$request->date_of_birth);


        if(!$isAuthenticUser->exists()){
            $this->setErrorMessage('Your NID or Date of birth does not verify.');
            return redirect()->back();
        }
        return redirect(route("vaccine-registration.userInformationPage"), 307);
    }

    public function userInformationPage(Request $request)
    {
        $user = User::where('nid',$request->nid)
                            ->where('date_of_birth',$request->date_of_birth)
                            ->first();

        $vaccineCenters = VaccineCenter::select('id','center_name')->get();
        return view('pages.vaccine_registration.user_information_page',compact('vaccineCenters','user'));
    }

    public function confirmationPage(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'mobile' => 'required|numeric',
            'email' => 'required|email',
            'vaccine_center_id' => 'required'
        ]);
        if($validator->fails()){
            return redirect(route("vaccine-registration.userInformationPage"), 307)->withErrors($validator)->withInput();
        }
        return view('pages.vaccine_registration.confirmation_page');
    }
}
