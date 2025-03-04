<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\GoogleController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\Authenticate;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Google Sign In
Route::post('/get-google-sign-in-url', [GoogleController::class, 'getGoogleSignInUrl']);
Route::get('/callback', [GoogleController::class, 'loginCallback']);


Route::middleware(['role'])->group(function () {
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});


