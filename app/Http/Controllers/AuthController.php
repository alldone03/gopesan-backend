<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\userpicture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image as convertImage;


class AuthController extends Controller
{
    function login(): mixed
    {
        $validated = request()->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);


        if (Auth::attempt($validated)) {
            $user = Auth::user();
            $token = $user->createToken('token')->plainTextToken;
            $response = [
                'user' => User::find($user->id),
                'mydata' => "hello",
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

        // dd($request);
        $validated = $request->validate([
            'name' => 'required',
            'password' => 'required',
            'file' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ]);
        if ($user->pathuserpicture) {
            unlink($user->pathuserpicture);
        }
        $webp_image = convertImage::make($request->file('file'))->encode('webp', 90)->save('storage/images/' . $request->file('file')->hashName() . '.webp');

        $hasil = $user->update([
            'name' => $validated['name'],
            'email' => $user['email'],
            'password' => bcrypt($validated['password']),
            'pathuserpicture' => $webp_image->basePath(),
        ]);


        if (!$hasil) {
            return response()->json([
                'message' => 'update register failed'
            ], 400);
        } else
            return response()->json([
                'message' => 'Update register success ',
                'data' => $webp_image->basePath(),
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
