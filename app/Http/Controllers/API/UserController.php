<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\UserService;

class UserController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }


    public function index()
    {
        $authenticateUsers = $this->userService->getAllAuthenticUsers();

        return view('pages.authenticate_users', compact('authenticateUsers'));
    }

    public function verifiedUsers()
    {
        $authenticateUsers = $this->userService->getAllAuthenticUsers();
        return response()->json($authenticateUsers);
    }
}
