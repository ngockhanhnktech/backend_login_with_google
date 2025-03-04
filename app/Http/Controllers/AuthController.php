<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AuthController extends Controller
{
    public function logout(Request $request)
{
    try {
        // Lấy user đang đăng nhập
        $user = auth()->user();
        if ($user) {
            // Xóa token hiện tại
            $request->user()->token()->revoke();

            return response()->json([
                'status' => __('Logged out successfully'),
            ], Response::HTTP_OK);
        }

        return response()->json([
            'status' => __('User not found'),
        ], Response::HTTP_NOT_FOUND);

    } catch (\Exception $exception) {
        return response()->json([
            'status' => __('Logout failed'),
            'error' => $exception->getMessage()
        ], Response::HTTP_BAD_REQUEST);
    }
}

}
