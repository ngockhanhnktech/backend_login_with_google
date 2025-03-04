<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function getGoogleSignInUrl()
    {
        try {
            $url = Socialite::driver('google')->stateless()
                ->redirect()->getTargetUrl();
            return response()->json([
                'url' => $url,
            ])->setStatusCode(Response::HTTP_OK);
        } catch (\Exception $exception) {
            return $exception;
        }
    }

    public function loginCallback(Request $request)
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();
            $user = User::where('email', $googleUser->email)->first();

            if (!$user) {
                $user = User::create([
                    'email' => $googleUser->email,
                    'name' => $googleUser->name,
                    'google_id' => $googleUser->id,
                    'password' => bcrypt('123'), // Placeholder, not used for Google login
                    'roles_id' => 2,
                ]);
            }

            // ✅ Generate Passport Token Correctly
            $token = $user->createToken('GoogleLoginToken')->accessToken;

            return response()->json([
                'status' => 'google sign in successful',
                'access_token' => $token,
                'token_type' => 'Bearer',
                'expires_at' => now()->addDays(15),
                'data' => $user,
            ], Response::HTTP_OK);
        } catch (\Exception $exception) {
            return response()->json([
                'status' => 'google sign in failed',
                'error' => $exception->getMessage()
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}
