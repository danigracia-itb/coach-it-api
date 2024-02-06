<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\UserData;
use Illuminate\Http\Request;
use App\Models\AvailableDays;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AthleteController extends Controller
{
    //Guardar la user data
    public function storeUserData(Request $request)
    {
        //Validar datos
        $validator = Validator::make(
            $request->all(),
            [
                'user_id' => "required",
                'date_birth' => "required",
                'height' => "required",
                'body_weight' => "required",
                'time_training' => "required",
                'train_available_time' => "required",
                'wishlist_exercises' => "required",
                'banlist_exercises' => "required",
                'short_term_goals' => "required",
                'long_term_goals' => "required",
                'available_days' => "required"
            ]
        );

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        //Save
        $userData = UserData::create([
            'user_id' => $request->user_id,
            'date_birth' => $request->date_birth,
            'height' => $request->height,
            'body_weight' => $request->body_weight,
            'time_training' => $request->time_training,
            'train_available_time' => $request->train_available_time,
            'wishlist_exercises' => $request->wishlist_exercises,
            'banlist_exercises' => $request->banlist_exercises,
            'short_term_goals' => $request->short_term_goals,
            'long_term_goals' => $request->long_term_goals,
        ]);

        $available_days = AvailableDays::create([
            'monday' => $request->available_days["monday"],
            'tuesday' => $request->available_days["tuesday"],
            'wednesday' => $request->available_days["wednesday"],
            'thursday' => $request->available_days["thursday"],
            'friday' => $request->available_days["friday"],
            'saturday' => $request->available_days["saturday"],
            'sunday' => $request->available_days["sunday"],
        ]);

        //Asignar días disponible
        $userData->availableDays()->associate($available_days);
        $userData->save();


        return response()->json([
            'success' => true,
        ]);
    }

    public function destroy($id) {
        $data = UserData::where("user_id", $id)->first();
        $data->delete();
        $athlete = User::findOrFail($id);
        $athlete->delete();
        return "success";
    }
}
