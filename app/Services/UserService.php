<?php

namespace App\Services;

use App\Contracts\RegistrationContract;
use App\Contracts\UserContract;
use Illuminate\Support\Facades\Validator;

class UserService
{
    private $userContract;

    private $registrationContract;

    public function __construct(UserContract $userContract, RegistrationContract $registrationContract)
    {
        $this->userContract = $userContract;
        $this->registrationContract = $registrationContract;
    }

    public function getAllAuthenticUsers()
    {
        return $this->userContract->getAll();
    }

    public function searchProcessing($request)
    {
        return $this->registrationContract->show($request->nid);
    }

    public function validation($request)
    {
        $validator = Validator::make($request->all(), [
            'nid' => 'numeric',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        return 0;
    }
}
