<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
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

    public function register(Request $request)
    {

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'email_verified' => false,
            'otp_expires_at' => Carbon::now()->addMinutes(10)
        ]);

        $this->sendOtp($user);


        $token = $user->createToken('authToken')->plainTextToken;

        return response()->json(
            [
                'token' => $token,
                'user' => $user
            ],
            200
        );

    }

    public function resendOtp(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|string|email|max:255|exists:users',
        ]);

        $user = User::where('email', $validatedData['email'])->first();

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $this->sendOtp($user);

    }

    public function verifyOtp(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|string|email|max:255|exists:users',
            'otp' => 'required|string|min:6|max:6',
        ]);

        $user = User::where('email', $validatedData['email'])->first();

        if (!$user || $user->otp !== $validatedData['otp']) {
            return response()->json(['message' => 'Invalid OTP or OTP expired'], 401);
        }

        // OTP is valid, generate token
        $user->otp = null;
        $user->otp_expires_at = null;
        $user->email_verified = true;
        $user->save();

        $token = $user->createToken('authToken')->plainTextToken;

        return response()->json(
            [
                'token' => $token,
                'user' => $user
            ],
            200
        );
    }

    public function sendOtp(User $user)
    {
        $otp = rand(100000, 999999); // Generate a 6-digit OTP
        $user->otp = $otp;
        $user->save();
        // Send OTP via email
        // Mail::raw("Your OTP code is $otp", function ($message) use ($user) {
        //     $message->to($user->email)
        //             ->subject('OTP Verification');
        // });

    }

    public function getUser(){
        $user = User::all();

        return response()->json(
            ['users' => $user],
            200);
    }

    public function logout(Request $request)
    {
        $user = $request->user();
        $user->tokens()->where('id', $user->currentAccessToken()->id)->delete();

        return response()->json(['message' => 'Logged out successfully'], 200);
    }
}
