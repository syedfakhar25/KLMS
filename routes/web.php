<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MigrationController;

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
Route::get('/dashboard', [\App\Http\Controllers\AdminController::class, 'dashboard'])->name('dashboard');
Route::get('/run-migrations', [MigrationController::class, 'runMigrations']);
Route::get('/test-email', [MigrationController::class, 'testEmail']);

