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
        $user = auth()->user(); // Lấy user từ Auth guard

    if (!$user) {
        return redirect()->route('login')->with('error', ' chưa đăng nhập!');
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
