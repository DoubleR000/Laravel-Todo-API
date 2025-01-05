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

        return response()->json([
            'message' => 'User successfully registered',
            'user' => $user
        ]);
    }
    public function login(LoginUserRequest $request)
    {

    }

    public function logout(Request $request)
    {

    }
}
