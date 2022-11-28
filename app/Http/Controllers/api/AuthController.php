<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(AuthUserRequest $request)
    {
        $user = User::where("email", $request->email)->first();
        // dd($user);

        if (!$user && !Hash::check($request->password, $user->password)) {
            return response()->json([
                "message" => "Las credenciales son incorrectas."
            ], 403);
        }

        $token = $user->createToken($user->email)->plainTextToken;

        return [
            "user" => $user,
            "token" => $token
        ];
    }

    public function logout()
    {
        Auth::user()->currentAccessToken()->delete();

        return response()->json([
            "message" => "Sesion cerrada."
        ]);
    }
}
