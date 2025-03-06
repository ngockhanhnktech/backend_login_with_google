<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\GoogleController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\Authenticate;
use App\Http\Controllers\AdminController;
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
// Route::get('auth/google', [GoogleController::class, 'getGoogleSignInUrl'])->name('google.login');
// Route::get('/callback', [GoogleController::class, 'loginCallback']);

// // Dashboard (protected)
// Route::get('/dashboard', [GoogleController::class, 'dashboard'])->name('dashboard')->middleware('auth');


// Route::middleware(['role'])->group(function () {
//     Route::post('logout', [AuthController::class, 'logout'])->name('logout');
// });


// Route::middleware(['auth.token', 'role'])->group(function () {
//     Route::post('/admin/update-role', [AdminController::class, 'updateRole'])
//         ->name('admin.updateRole');
// });

Route::middleware(['auth:api', 'role'])->group(function () {
    Route::post('/admin/update-role', [AdminController::class, 'updateRole'])
        ->name('admin.updateRole');
});
