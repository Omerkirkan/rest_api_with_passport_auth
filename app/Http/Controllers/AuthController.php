<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request) {
        $email = $request->email;
        $password = $request->password;

        $user = User::where('email', $email)->first();
        if (!$user || !Hash::check($password, $user->password)) {
            return response([
                'message' => 'Bad creds'
            ], 401);
        }

        $token = $user->createToken("login")->accessToken;

        return $token;
    }

    public function register(Request $request) {

        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed',
        ]);

        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password'])
        ]);

        $response = [
            'user' => $user
        ];

        return response($response, 201);
    }

    public function getUser() {
        return Auth::user();
    }
}
