<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Mail\PasswordRecoverMail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class PasswordRecoverController extends Controller
{
        /**
     * Request password reset.
     */
    public function requestPasswordRecover(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|exists:users,email',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }



        $token = Str::random(20);

        $user = User::where("email", $request->email)->first();
        $user->password_reset_token = $token;
        $user->save();

        Mail::to($user->email)->send(new PasswordRecoverMail($token, $user->name));

        return response()->json([
            'status' => 'success',
            'msg' => 'Password change requested succesfully!'
        ]);
    }

    /**
     * Reset password.
     */
    public function passwordRecover(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|string|min:8|max:255',
            'token' => 'required|string|min:20|max:20'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $user = User::where("password_reset_token", $request->token)->first();

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'msg' => 'Invalid token',
            ], 403);
        }

        $user->password = bcrypt($request->password);
        $user->password_reset_token = null;
        $user->save();

        return response()->json([
            "type" => $user->type,
            'status' => 'success',
            'msg' => 'Password updated succesfully!'
        ]);
    }


}
