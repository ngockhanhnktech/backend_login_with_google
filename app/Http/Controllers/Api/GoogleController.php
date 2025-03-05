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
        // Kiểm tra nếu user đã đăng nhập (có session hoặc token)
        if (session()->has('user')) {
            return redirect()->route('dashboard'); // Chuyển thẳng vào Dashboard
        }
    
        // Nếu chưa có session, buộc Google hiển thị trang chọn tài khoản
        return Socialite::driver('google')
            ->stateless()
            ->with(['prompt' => 'select_account'])
            ->redirect();
    }
    

    public function loginCallback()
    {

        try {
            $googleUser = Socialite::driver('google')->stateless()->user();
            // dd($googleUser);
            $user = User::firstOrCreate(
                ['email' => $googleUser->email],
                [
                    'name' => $googleUser->name,
                    'google_id' => $googleUser->id,
                    'password' => bcrypt(12345)
                ]
            );


            Auth::login($user, true);
            session(['user' => $user]);

            return redirect()->route('dashboard');
        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Đăng nhập thất bại!');
        }
    }




    public function dashboard()
    {
        // Xóa session để buộc chọn tài khoản Google khi đăng nhập lại
        // session()->forget('user');
        // dd(session()->all());
        if (!session()->has('user')) {
            return redirect()->route('login');
        }

        $user = session('user');

        return view('auth.dashboard', compact('user'));
    }
}
