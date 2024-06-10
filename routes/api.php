<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login'])->name('login');
Route::post('/signUp', [\App\Http\Controllers\AuthController::class, 'signUp']);
Route::post('/verify-otp', [\App\Http\Controllers\AuthController::class, 'verifyOtp']);
Route::post('/resend-otp', [\App\Http\Controllers\AuthController::class, 'resendOtp']);



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function () {
    Route::resource('users', \App\Http\Controllers\UserContoller::class);

    Route::resource('premises', \App\Http\Controllers\PremesisController::class);
    Route::resource('ownership', \App\Http\Controllers\OwnershipController::class);
    Route::resource('herd', \App\Http\Controllers\HerdController::class);
    Route::resource('vaccination', \App\Http\Controllers\VaccincationController::class);
    Route::resource('animal', \App\Http\Controllers\AnimalController::class);

    // send general data:
    Route::get('/settings', [\App\Http\Controllers\AllDataController::class, 'allData'])->name('settings');
    Route::get('/dashboard', [\App\Http\Controllers\AdminController::class, 'dashboard'])->name('dashboard');
});
Route::middleware('auth:sanctum')->post('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');