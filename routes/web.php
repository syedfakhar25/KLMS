<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MigrationController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\FilterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
Route::get('/premises', [AdminController::class, 'showPremises'])->name('premises.list');

Route::get('/filters/districts', [FilterController::class, 'getDistricts']);
Route::get('/filters/tehsils/{districtId}', [FilterController::class, 'getTehsils']);
Route::get('/filters/councils/{tehsilId}', [FilterController::class, 'getCouncils']);
Route::get('/filters/villages/{councilId}', [FilterController::class, 'getVillages']);


Route::get('/run-migrations', [MigrationController::class, 'runMigrations']);
Route::get('/test-email', [MigrationController::class, 'testEmail']);

