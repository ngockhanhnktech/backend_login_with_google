<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Permission;
class RoleMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        dd($user);
        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        // 🔥 Kiểm tra quyền từ bảng Permission
        $routeName = $request->route()->getName();
        $hasPermission = \App\Models\Permission::where('roles_id', $user->roles_id)
            ->where('route', $routeName)
            ->exists();

        if (!$hasPermission) {
            return response()->json(['error' => 'Forbidden: Access denied'], 403);
        }

        return $next($request);
    }
}
