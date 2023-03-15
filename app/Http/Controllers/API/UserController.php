<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $authenticateUsers = User::get();

        return view('pages.authenticate_users',compact('authenticateUsers'));
    }

    public function verifiedUsers()
    {
        $allVerfiedUsers = User::select('nid','date_of_birth')->get();
        return $allVerfiedUsers;
        return response()->json($allVerfiedUsers);

    }
}
