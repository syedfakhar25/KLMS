<?php

namespace App\Http\Controllers;

use http\Client\Curl\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('authToken')->plainTextToken;

            return response()->json(
                [
                    'token' => $token,
                    'user' => $user
                ],
                200);
        }

        return response()->json(['message' => 'Unauthorized'], 401);
    }

    public function getUser(){
        $user = \App\Models\User::all();

        return response()->json(
            ['users' => $user],
            200);
    }
}
