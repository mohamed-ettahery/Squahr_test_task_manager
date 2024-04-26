<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ]);
        if ($validation->fails()) {
            return response()->json($validation->errors(), 202);
        }
        $data = $request->all();
        // $data['password'] = bcrypt($request->password);
        $data['password'] = Hash::make($request->password);
        $user = User::create($data);
        $res = [
            // 'token' => $user->createToken('api-application')->accessToken,
            'name' => $user->name,
            'email' => $user->email
        ];
        return response()->json($res, 200);
    }


    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(["errors" => $validator->errors()], 202);
        }
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            /** @var \App\Models\User $user **/
            $user = Auth::user();
            $res = [
                // 'token' => $user->createToken('api-application')->accessToken,
                'token' => $user->createToken("user_token")->plainTextToken,
                'name' => $user->name,
                'email' => $user->email
            ];
            return response()->json($res, 200);
        } else {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }
    }
    // function logout()
    // {
    //     if (auth()->check()) {
    //         $token = auth()->user()->currentAccessToken();
    //         if ($token) {
    //             $token->delete();
    //             return response()->json(["message" => "You logged out successfully!"]);
    //         } else {
    //             return response()->json(["message" => "No token found."], 400);
    //         }
    //     }

    //     return response()->json(["message" => "You are not logged in."], 401);
    // }
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Logged out successfully'], 200);
    }
}
