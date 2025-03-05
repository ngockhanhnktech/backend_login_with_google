<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class GoogleController extends Controller
{
    public function getGoogleSignInUrl()
    {
        if (session()->has('user_id')) {
            return redirect()->route('dashboard'); // Nếu đã login, chuyển đến dashboard
        }

        return Socialite::driver('google')
            ->stateless()
            ->with(['prompt' => 'select_account'])
            ->redirect();
    }

    public function loginCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();

            $user = User::updateOrCreate(
                ['email' => $googleUser->email],
                [
                    'name' => $googleUser->name,
                    'google_id' => $googleUser->id,
                    'password' => bcrypt('password123') 
                ]
            );
            Auth::login($user, true); // Laravel sẽ lưu user vào Auth guard
            return redirect()->route('dashboard');
        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Đăng nhập thất bại!');
        }
    }

    public function dashboard()
    {
        $user = auth()->user(); // Lấy user từ Auth guard
        // dd($user->name);
        if (!$user) {
            return redirect()->route('login')->with('error', 'Bạn chưa đăng nhập!');
        }
    
        return view('auth.dashboard', compact('user'));
       
    }
}
