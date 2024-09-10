<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\v1\AuthController;
use App\Providers\AppServiceProvider;
use Laravel\Passport\Passport;

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


//Open Route
Route::post('register', [AuthController::class, 'register'])->name('Api_register');
Route::post('login', [AuthController::class, 'login'])->name('Api_login');


//Protected Route
Route::middleware(['checkApiToken'])->group(function () {
    Route::get('profile', [AuthController::class, 'profile'])->name('Api_profile');
    Route::post('logout', [AuthController::class, 'logout'])->name('Api_logout');
});



