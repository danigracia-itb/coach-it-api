<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
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

        if (!Auth::attempt($data)) {
            return response()->json([
                'status' => 'error',
                'msg' => 'Unauthorized',
            ], 401);
        }

        $user = Auth::user();
        $token = $user->createToken('authToken')->plainTextToken;

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
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string',
            'is_coach' => 'boolean',
            'coach_id' => 'nullable|exists:users,id',
        ]);

        if ($validator->fails()) {
            return response()->json(["error" => $validator->messages()], 400);
        }

        $data['password'] = bcrypt($data['password']);

        $user = User::create($data);

        return response()->json([
            'status' => 'success',
            'user' => $user,
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'status' => 'success',
            'msg' => 'Logged out successfully',
        ]);
    }

    public function getUser(Request $request)
    {
        return true;
    }
}
