<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    function login(): mixed
    {
        $validated = request()->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        // dd($validated);

        if (Auth::attempt($validated)) {
            $user = Auth::user();
            $token = $user->createToken('token')->plainTextToken;
            $response = [
                'user' => $user,
                'token' => $token
            ];
            return response()->json([
                'message' => 'Login success', ...$response
            ], 200);
        }
        return response()->json([
            'message' => 'Login failed'
        ], 400);
    }
    function update(User $user, Request $request): mixed
    {
        if (auth()->user()->id != $user->id) {
            return response()->json([
                'message' => 'update register failed'
            ], 400);
        }
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
        ]);
        $hasil = $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
        ]);
        if (!$hasil) {
            return response()->json([
                'message' => 'update register failed'
            ], 400);
        } else
            return response()->json([
                'message' => 'Update register success'
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
        if ($status)
            return response()->json([
                'message' => "Berhasil logout",
            ], 200);
        else
            return response()->json([
                'message' => "Gagal logout",
            ], 403);
    }
    function getuserdata(): mixed
    {

        return response()->json([
            'message' => 'success',
            'data' => request()->user()
        ], 200);
    }
}
