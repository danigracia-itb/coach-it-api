<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\Exercise;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Workout;

class CoachController extends Controller
{
    public function getAthletes($id)
    {
        $athletes = User::where("coach_id", $id)->get();
        return $athletes;
    }
    public function getAthleteProfile($id) {
        $athlete = User::where("id", $id)->with("userData.availableDays")->first();
        return $athlete;
    }

    public function getAthleteWorkouts($id) {
        //TODO: OBTENER SETS Y EJERCICIO
        $workouts = Workout::where("user_id", $id)->with("exercises")->get();
        return $workouts;
    }


}
