<?php

// app/Http/Controllers/API/AuthController.php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {

        $credentials = $request->only('email', 'password');

        $error = [
            "success" => false,
            "data" => [],
            "message" => "Email  Password does not match with our record",
            "status_code" => 401,
            "error_code" => "",
            "errors" => []
        ];

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('authToken')->plainTextToken;

            return response()->json(
                [
                    "success" => true,
                    "data" => [
                        'user' => $user,
                        'token' => $token,
                    ],
                    "message" => "Login successful",
                    "status_code" => 401,
                    "error_code" => "",
                    "errors" => []
                ]
            );
        }

        return response()->json($error, 401);
    }

    public function user(Request $request)
    {
        return response()->json(['user' => $request->user()]);
    }
}