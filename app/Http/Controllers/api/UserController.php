<?php

namespace App\Http\Controllers\api;

use App\Models\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'nom' =>'required|max:255',
            'prenom' =>'required|max:255',
            'tel' =>'numeric',
            'email' =>'required|email|max:255|unique:users',
            'password' =>'required',
        ]);

        $user = User::create([
            "nom" => $request->nom,
            "prenom" => $request->prenom,
            "tel" => $request->tel,
            "email" => $request->email,
            "password" => Hash::make($request->password),
        ]);

        $token = JWTAuth::fromUser($user);
        
        return response()->json([
            "message" => "User Created",
            "token" => $token,
            "user"    => $user,
        ]);
    }

    public function login(Request $request) {
        $request->validate([
            'email' =>'required|email',
            'password' =>'required',
        ]);

        $credentials = $request->only('email', "password");

        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return response()->json([
            "message" => "You are logged in",
            "token" => $token,
        ]);
    }

    public function logout()
    {
        JWTAuth::invalidate(JWTAuth::getToken());
        return response()->json(['message' => 'User logged out']);
    }
}
