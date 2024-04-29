<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class authController extends Controller
{
    public function register(Request $request)
    {
        // Validate incoming registration request
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        $credentials = request(['email', 'password']);
        $token = auth()->guard('api')->attempt($credentials);
        if (!$token) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $user = auth()->guard('api')->user();
        if ($user->is_login == 1) {
            return response()->json(['error' => 'You must first log out from another device'], 401);
        }
        $user->is_login = true;
        $user->save();

        return response()->json([
            'message' => 'User registered successfully',
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 9999999,
            'user' => $user,
        ], 201);
    }
    public function login()
    {
        $credentials = request(['email', 'password']);
        $token = auth()->guard('api')->attempt($credentials);
        if (!$token) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $user = auth()->guard('api')->user();
        if ($user->is_login == 1) {
            return response()->json(['error' => 'You must first log out from another device'], 401);
        }
        $user->is_login = true;
        $user->save();

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 9999999
        ]);
    }
    public function update(Request $request)
    {
        $user = auth()->guard('api')->user();
        if ($user) {
            $user->update($request->all());
            return response()->json(['message' => 'Update Successfully']);
        }
        return response()->json(['error' => 'Invalid token'], 401);
    }
    public function changePassword(Request $request)
    {
        // Validate incoming request data
        $validator = Validator::make($request->all(), [
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 422);
        }

        $user = auth()->guard('api')->user();

        if (!$user) {
            return response()->json(['error' => 'Invalid token'], 401);
        }

        // Update the user's password
        $user->password = bcrypt($request->password);
        $user->save();

        return response()->json(['message' => 'Password changed successfully'], 200);
    }

    public function me()
    {
        return response()->json(auth()->guard('api')->user());
    }

    public function logout()
    {
        $user = auth()->guard('api')->user();
        if ($user) {
            $user->is_login = false;
            $user->save();
            return response()->json(['message' => 'Successfully logged out']);
        }
        return response()->json(['error' => 'you are alredy log out']);
    }

}
