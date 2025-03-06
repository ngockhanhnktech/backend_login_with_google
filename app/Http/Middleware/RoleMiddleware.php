<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next)
    {

        Auth::shouldUse('api');

        $user = Auth::guard('api')->user();
        if (!$user) {
            // \Log::error('User not found or token invalid', ['token' => $token]);
            return response()->json(['error' => 'Bạn chưa đăng nhập!'], 401);
        }

        $routeName = $request->route()->getName();


        $hasPermission = Permission::where('roles_id', $user->roles_id)
            ->where('route', $routeName)
            ->exists();


        if (!$hasPermission) {
            return response()->json(['error' => 'Forbidden: Access denied'], 403);
        }


        return $next($request);
    }
}
