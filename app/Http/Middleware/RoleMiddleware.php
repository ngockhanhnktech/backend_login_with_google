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
        $email = auth()->check() ? auth()->user()->email : null;
       
        if (!$email) {
            return redirect()->route('login')->with('error', 'Bạn chưa đăng nhập!');
        }
       
        // Lấy user từ database theo email
        $user = User::where('email', $email)->first();
        $roleId = $user->roles_id;

        if (!$user) {
            return redirect()->route('login')->with('error', 'Không tìm thấy người dùng!');
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
