<?php

namespace app\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Handle user registration.
     */
    public function register(Request $request)
    {
        // 1. Validation (Requires 'password_confirmation' field from frontend)
        $fields = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // 2. Create the User
        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => Hash::make($fields['password']),
        ]);

        // 3. Generate a Sanctum Token (Logs the user in immediately)
        $token = $user->createToken('auth_token')->plainTextToken;

        // 4. Return the response to the frontend
        return response()->json([
            'message' => 'Registration successful',
            'user' => $user,
            'access_token' => $token,
            'token_type' => 'Bearer',
        ], 201);
    }

    /**
     * Handle user login.
     */
    public function login(Request $request)
    {
        // 1. Validation
        $fields = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // 2. Attempt Authentication
        if (!Auth::attempt($fields)) {
            // Failed login attempt
            return response()->json([
                'message' => 'Invalid email or password'
            ], 401); // 401 Unauthorized
        }

        // 3. Get the authenticated user
        $user = Auth::user();

        // 4. Generate a Sanctum Token
        $token = $user->createToken('auth_token')->plainTextToken;

        // 5. Return the response to the frontend
        return response()->json([
            'message' => 'Login successful',
            'user' => $user,
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }
}