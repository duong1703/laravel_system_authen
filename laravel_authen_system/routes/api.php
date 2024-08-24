<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\v1\AuthController;
use App\Providers\AppServiceProvider;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:api');


//Open Route
Route::post('register', [AuthController::class, 'register'])->name('Api_register');
Route::post('login', [AuthController::class, 'login'])->name('Api_login');


//Protected Route
Route::group(['middleware' => ['auth:api']], function (){
    Route::get('profile', [AuthController::class, 'profile'])->name('Api_profile');
    Route::get('logout', [AuthController::class, 'logout'])->name('Api_logout');
});


