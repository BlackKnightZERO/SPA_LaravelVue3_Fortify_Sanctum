<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
// use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Models\User;


class AuthController extends Controller
{
    public function login(LoginRequest $request) {

        $validated = $request->validated();
        
        if (!auth()->attempt($validated)) {
            return response()->json([
                'status' => 401,
                'message' => 'Wrong Credentials',
                'data' => null
            ], 401);
        }

        return response()->json([
            'status' => 200,
            'message' => 'Logged In',
            'data' => auth()->user(),
            'token' => auth()->user()->createToken('API Token')->plainTextToken
        ], 200);

    }

    public function register(Request $request) {

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'phone' => ['sometimes', 'required'],
            'image' => ['sometimes', 'required'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
        ]);

        // event(new Registered($user));

        return response()->json([
            'status' => 201,
            'message' => 'Registered',
            'data' => $user,
        ], 200);

    }


    public function logout(Request $request) {

        auth()->user()->tokens()->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Logged Out',
            'data' => null
        ], 200);

    }
}
