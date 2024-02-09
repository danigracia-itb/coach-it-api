<?php

namespace App\Http\Controllers\API;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Intervention\Image\Image;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public $token = true;

    public function register(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'email' => 'required|email',
                'password' => 'required',
                'is_coach' => 'required | boolean',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }


        $user = new User([
            "id" => random_int(100000, 999999),
            "name" => $request->name,
            "email" => $request->email,
            "password" => bcrypt($request->password)
        ]);

        if ($request->is_coach == true) {
            $user->is_coach = true;
        }

        if ($request->coach_id && $request->is_coach == false) {
            $user->coach_id = $request->coach_id;
        }

        $user->save();

        if ($this->token) {
            return $this->login($request);
        }

        return response()->json([
            'success' => true,
            'data' => $user
        ], Response::HTTP_OK);
    }

    public function login(Request $request)
    {
        $input = $request->only('email', 'password');
        $jwt_token = null;

        if (!$jwt_token = JWTAuth::attempt($input)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid Email or Password',
            ], Response::HTTP_UNAUTHORIZED);
        }

        return response()->json([
            'success' => true,
            'token' => $jwt_token,
            'user' => Auth::user(),
        ]);
    }

    public function logout(Request $request)
    {

        try {
            JWTAuth::invalidate(JWTAuth::parseToken($request->token));

            return response()->json([
                'success' => true,
                'message' => 'User logged out successfully'
            ]);
        } catch (JWTException $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, the user cannot be logged out'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function getUser(Request $request)
    {
        try {
            $user = JWTAuth::authenticate($request->token);
            return response()->json(['user' => $user]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized',
            ], Response::HTTP_UNAUTHORIZED);
        }
    }


    public function show($id)
    {
        $user = User::findOrFail($id);
        return $user;
    }

    public function changeName(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->name = $request->input("name");
        $user->save();
        return "success";
    }

    public function changePicture(Request $request, $id)
    {
        $user = User::findOrFail($id);

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'msg' => 'Not Found',
            ], 404);
        }

        $image = $request->image;

        // Genera un nombre único para la imagen
        $imageName = time() . '_' . $image->getClientOriginalName();

        // Guarda la imagen en la carpeta de almacenamiento de imágenes
        $image->storeAs('public/images', $imageName);

        // Asigna la ruta de la imagen al campo 'picture' del usuario
        $user->picture = 'storage/images/' . $imageName;
        $user->save();

        return response()->json($user, 201);
    }

    public function changeData(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->name = $request->input("name");
        $user->email = $request->input("email");
        $user->save();
        return "success";
    }

    public function changeCoach(Request $request, $id)
    {
        $user = User::findOrFail($id);

        if($request->input("coach_id") != "nocoach") {
            $validator = Validator::make(
                $request->all(),
                [
                    'coach_id' => 'required|exists:users,id',
                ]
            );

            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 401);
            }

            $user->coach_id = $request->input("coach_id");
        } else {
            $user->coach_id = null;
        }

        $user->save();

        return $user;
    }
}
