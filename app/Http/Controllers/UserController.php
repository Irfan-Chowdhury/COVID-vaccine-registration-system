<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $authenticateUsers = User::get();

        return view('pages.authenticate_users',compact('authenticateUsers'));
    }
}
