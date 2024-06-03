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

        $token = auth()->guard('api')->attempt($validatedData); // Using $validatedData directly here is cleaner

        if (!$token) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $user = auth()->guard('api')->user();

        if ($user->is_login == 1) {
            return response()->json(['error' => 'يجب عليك تسجيل الخروج من جهاز آخر أولاً'], 401);
        }

        $user->is_login = true;
        $user->save();

        return response()->json([
            'message' => 'تم تسجيل المستخدم بنجاح',
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 9999999, // This seems like an arbitrarily large number, consider revising
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
            return response()->json(['error' => 'يجب عليك تسجيل الخروج من جهاز آخر أولاً'], 401);
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
            return response()->json([
                'message' => 'تم التحديث بنجاح',
                'data' => $user
            ]);
        }
        return response()->json(['error' => 'Invalid token'], 401);
    }
    public function changePassword(Request $request)
    {
        // Validate incoming request data
        $validator = Validator::make($request->all(), [
            'old_password' => 'required|string',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 422);
        }

        $user = auth()->guard('api')->user();

        if (!$user) {
            return response()->json(['error' => 'Invalid token'], 401);
        }
        if (!Hash::check($request->old_password, $user->password)) {
            return response()->json(['error' => 'كلمة سر قديمة ليست صحيحة'], 422);
        }

        $user->password = bcrypt($request->password);
        $user->save();

        return response()->json(['message' => 'تم تغيير الرقم السري بنجاح'], 200);
    }


    public function me()
    {
        return response()->json(auth()->guard('api')->user());
    }

    public function deleteUser()
    {
        $user = auth()->guard('api')->user();

        if ($user) {
            $user->delete();
            return response()->json([
                'success' => true,
                'message' => 'تم حذف المستخدم بنجاح'
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'لم يتم العثور على المستخدم أو لم يتم التحقق من صحته'
            ], 404);
        }
    }
    public function logout()
    {
        $user = auth()->guard('api')->user();
        if ($user) {
            $user->is_login = 0;
            $user->save();
            return response()->json(['message' => 'تم تسجيل الخروج بنجاح']);
        }
        return response()->json(['error' => 'لقد قمت بتسجيل الخروج بالفعل']);
    }

}
