<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\VaccineCenterController;
use App\Http\Controllers\VaccineRegistrationController;
use Illuminate\Support\Facades\Route;

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

Route::get('/alpha', function () {
    return view('alpha');
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/vaccine-center-list', [VaccineCenterController::class, 'index'])->name('vaccine-center-list');

Route::group(['prefix' => 'vaccine-registration'], function () {
    Route::get('/', [VaccineRegistrationController::class, 'userIdentificationPage'])->name('vaccine-registration.userIdentificationPage');
    Route::post('/user-identification-proess', [VaccineRegistrationController::class, 'userIdentificationProcess'])->name('vaccine-registration.userIdentificationProcess');
    Route::post('/user-information', [VaccineRegistrationController::class, 'userInformationPage'])->name('vaccine-registration.userInformationPage');
    Route::post('/confirmation', [VaccineRegistrationController::class, 'confirmationPage'])->name('vaccine-registration.confirmationPage');
    Route::post('/confirmation-process', [VaccineRegistrationController::class, 'confirmationProcess'])->name('vaccine-registration.confirmationProcess');
});

Route::group(['prefix' => 'users'], function () {
    Route::get('/authenticate', [UserController::class, 'index'])->name('users.index');
    Route::get('/search', [UserController::class, 'searchPage'])->name('users.searchPage');
    Route::post('/search', [UserController::class, 'searchProcess'])->name('users.searchProcess');
});
