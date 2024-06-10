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

        $user = User::where('email',  $request->input('email'))->first();

        if ($user) {
            return response()->json(['error' => 
            ['email'=>
            'User already registered']], 404);
        }

        $otp = rand(100000, 999999); // Generate a 6-digit OTP

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'otp' => $otp,
            'otp_expires_at' => Carbon::now()->addMinutes(10),
            'email_verified' => 0
        ]);

        $this->sendOtp($user);

        return response()->json(['message' => 'OTP sent to your email. Please verify.'], 201);
    }

    public function resendOtp(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|string|email|max:255',
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
            'email' => 'required|string|email|max:255',
            'otp' => 'required|string|min:6|max:6',
        ]);

        // Handle validation failures
        if ($validatedData->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validatedData->errors()
            ], 422);
        }

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
        Mail::raw("Your OTP code is $otp", function ($message) use ($user) {
            $message->to($user->email)
                    ->subject('OTP Verification');
        });

        return response()->json(['message' => 'OTP resent to your email. Please verify.'], 200);
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
