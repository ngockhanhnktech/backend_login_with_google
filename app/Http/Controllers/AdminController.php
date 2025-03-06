<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role']);
    }
    public function updateRole(Request $request){

        $user = auth()->user();
        
        if($user->roles_id !=1){
            return response()->json(['error'=>'Unauthorized'],403);
        }

        $request->validate([
            'user_id'=>'required|exists:users,id',
            'roles_id'=>'required|integer'
        ]);

        $user=User::findOrFail($request->user_id);
        $user->Update(['roles_id'=>$request->roles_id]);
        return response()->json(['message' => 'Role updated successfully', 'user' => $user]);
    }


}
