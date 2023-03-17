<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;

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

    public function searchPage()
    {
        return view('pages.search');
    }

    public function searchProcess(Request $request)
    {
        if ($this->userService->validation($request) !== 0) {
            return $this->userService->validation($request);
        }
        $registration = $this->userService->searchProcessing($request);

        return view('pages.search', compact('registration'));
    }
}
