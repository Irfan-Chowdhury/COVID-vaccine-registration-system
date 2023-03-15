<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VaccineCenterController;
use App\Http\Controllers\VaccineRegistrationController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/authenticate-users', [UserController::class, 'index']);
Route::get('/vaccine-centers', [VaccineCenterController::class, 'index']);

Route::group(['prefix' => 'vaccine-registration'], function (){
    Route::get('/', [VaccineRegistrationController::class, 'userIdentificationPage'])->name('vaccine-registration.userIdentificationPage');
    Route::post('/user-identification-proess', [VaccineRegistrationController::class, 'userIdentificationProcess'])->name('vaccine-registration.userIdentificationProcess');
    Route::post('/user-information', [VaccineRegistrationController::class, 'userInformationPage'])->name('vaccine-registration.userInformationPage');
    Route::post('/confirmation', [VaccineRegistrationController::class, 'confirmationPage'])->name('vaccine-registration.confirmationPage');
});


