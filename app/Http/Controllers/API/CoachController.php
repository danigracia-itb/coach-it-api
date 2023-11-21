<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CoachController extends Controller
{
    public function getAthletes($id)
    {
        $athletes = User::where("coach_id", $id)->get();
        return $athletes;
    }
    public function getAthleteProfile($id) {
        //TODO: Add form info

        $athlete = User::where("id", $id)->first();
        return $athlete;
    }
}
