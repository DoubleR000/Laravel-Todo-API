<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function register(RegisterUserRequest $request)
    {
        $data = $request->validated();
        $data["password"] = Hash::make($data["password"]);

        $user = User::create($data);

        $token = $user->createToken($request->name);

        return response()->json([
            'message' => 'User successfully registered!',
            'user' => $user,
            'token' => $token->plainTextToken
        ]);
    }
    public function login(LoginUserRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Invalid credentials.'
            ], 401);
        }

        $token = $request->user()->createToken($request->name);
        return response()->json([
            'message' => 'You have successfully logged in!',
            'token' => $token->plainTextToken
        ]);

    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'You are logged out.'
        ]);
    }
}
