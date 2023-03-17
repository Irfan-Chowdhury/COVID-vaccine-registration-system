<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use App\Models\Test;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    public function test()
    {
        return 1;
    }

    public function testStore()
    {
        Test::create([
            'center_name' => 'XYZ',
            'single_day_limit' => 20,
        ]);
        return 'ok';
    }




    public function index()
    {
        $authenticateUsers = User::get();
        return view('pages.authenticate_users', compact('authenticateUsers'));
    }

    public function searchPage()
    {
        return view('pages.search');
    }

    public function searchProcess(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nid' => 'numeric',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $registration = Registration::with('vaccineCenter')->where('nid', $request->nid)->first() ?? 0;

        return view('pages.search', compact('registration'));
    }
}
