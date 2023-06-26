<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    function login(): mixed
    {
        $validate = request()->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $user = User::where('email', $validate['email'])->first();
        if (!$user || !Hash::check($validate['password'], $user->password)) {
            return response()->json([
                'message' => 'Login failed'
            ], 401);
        }
        $token = $user->createToken('token')->plainTextToken;
        $response = [
            'user' => $user,
            'token' => $token
        ];
        return response()->json([
            'message' => 'Login success', ...$response
        ], 200);
    }
    function register(): mixed
    {
        $validate = request()->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',

        ]);
        User::create([
            'name' => $validate['name'],
            'email' => $validate['email'],
            'password' => bcrypt($validate['password']),
            'roleid' => 1,
        ]);
        return response()->json([
            'message' => 'register success'
        ], 201);
    }
    function logout(): mixed
    {
        $user = request()->user();
        $status = $user->tokens()->where('id', $user->currentAccessToken()->id)->delete();
        if ($status) {
            return response()->json([
                'message' => "Berhasil logout",
            ], 200);
        } else {
            return response()->json([
                'message' => "Gagal logout",
            ], 403);
        }
    }
    function getuserdata(): mixed
    {

        return response()->json([
            'message' => 'success',
            'data' => request()->user()
        ], 200);
    }
}
