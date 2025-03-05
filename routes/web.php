<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\GoogleController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\Authenticate;
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
Route::get('/dashboard', [GoogleController::class, 'dashboard'])->name('dashboard')->middleware('auth');


Route::get('/logout', function () {
    session()->flush(); // Xóa toàn bộ session
    return redirect('/login');
})->name('logout');

