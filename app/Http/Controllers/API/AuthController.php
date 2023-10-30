<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register', 'getUser']]);
    }

    public function login(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(["error" => $validator->messages()], 400);
        }

        $credentials = $request->only('email', 'password');

        if (!$token = Auth::attempt($credentials)) {
            return response()->json([
                'status' => 'error',
                'msg' => 'Unauthorized',
            ], 401);
        }

        $user = Auth::user();
        return response()->json([
            'status' => 'success',
            'user' => $user,
            'authorization' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]);
    }

    public function register(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json(["error" => $validator->messages()], 400);
        }

        $user = User::create([
            "id" => random_int(000001, 999999),
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_coach' => $request->input('is_coach', false), // Assuming is_coach is provided in the request
            'coach_id' => $request->input('coach_id', null), // Assuming coach_id is provided in the request
        ]);

        $token = Auth::login($user);
        return response()->json([
            'status' => 'success',
            'msg' => 'User created successfully',
            'user' => $user,
            'authorization' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return response()->json([
            'status' => 'success',
            'msg' => 'Successfully logged out',
        ]);
    }

    public function refresh()
    {
        return response()->json([
            'status' => 'success',
            'user' => Auth::user(),
            'authorization' => [
                'token' => Auth::refresh(),
                'type' => 'bearer',
            ]
        ]);
    }

    public function getUser(Request $request)
    {
        $token = $request->token;
        $user = Auth::setToken($token)->user();
        if (!$user) {
            return response()->json([
                'status' => 'error',
                'msg' => 'Invalid token',
            ], 401);
        }
        return response()->json([
            'status' => 'success',
            'user' => $user,
        ]);
    }
}
