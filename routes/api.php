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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function () {
    // Route to retrieve all users
    Route::resource('premises', \App\Http\Controllers\PremesisController::class);



    Route::get('/users/{id}', function ($id) {
        // Your logic to retrieve a user by ID
    });

    // Route for product-related endpoints
    Route::prefix('products')->group(function () {
        // Route to retrieve all products
        Route::get('/', function () {
            // Your logic to retrieve all products
        });

        // Route to retrieve a specific product by ID
        Route::get('/{id}', function ($id) {
            // Your logic to retrieve a product by ID
        });

    });

});
