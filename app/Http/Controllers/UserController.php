<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    function register(Request $request)
    {
        $data = new User();
        
        $data->name = $request->name;
        $data->email = $request->email;
        $data->password = Hash::make($request->password);
        $data->role = "Admin";
        $data->save();
        return response()->json(['redirect' => "/login"]);
    }

    public function login_user(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return response()->json(['error' => 'Invalid Credentials'], 401);
        }

        elseif (!Hash::check($request->password, $user->password)) {
            return response()->json(['error' => 'Invalid Credentials'], 401);
        }

        session([
            'role_id' => $user->role,
            'user_id' => $user->id,
            'user_name' => $user->name,
        ]);

        if ($user->role == 'Admin') {
            return response()->json(['redirect' => 'home']);
        }
        return response()->json(['error' => 'Invalid User'], 403);
    }
}
