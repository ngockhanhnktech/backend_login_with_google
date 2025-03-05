<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\GoogleController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Auth;
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

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// Google OAuth routes
Route::get('auth/google', [GoogleController::class, 'getGoogleSignInUrl'])->name('google.login'); // Chuyển hướng tới Google
Route::get('/callback', [GoogleController::class, 'loginCallback']); // Google trả về backend

// Dashboard đăng nhập
// Route::get('/dashboard', [GoogleController::class, 'dashboard'])->name('dashboard')->middleware('auth');

Route::get('/dashboard', [GoogleController::class, 'dashboard'])
    ->name('dashboard')
    ->middleware(['role']);


Route::get('/logout', function () {
    Auth::logout(); 
    return redirect('/login');
})->name('logout');

