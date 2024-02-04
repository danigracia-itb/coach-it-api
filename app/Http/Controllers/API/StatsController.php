<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use App\Models\Set;
use App\Models\Workout;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StatsController extends Controller
{
    public function daysTrainedLastMonth($id)
    {
        $firstDayOfLastMonth = Carbon::now()->subMonth()->startOfMonth();
        $lastDayOfLastMonth = Carbon::now()->subMonth()->endOfMonth();

        $daysTrained = Workout::where('user_id', $id)
            ->whereBetween('date', [$firstDayOfLastMonth, $lastDayOfLastMonth])
            ->count();

        return $daysTrained;
    }

    public function daysTrainedThisMonth($id)
    {
        $firstDayOfThisMonth = Carbon::now()->startOfMonth();
        $now = Carbon::now();

        $daysTrained = Workout::where('user_id', $id)
            ->whereBetween('date', [$firstDayOfThisMonth, $now])
            ->count();

        return $daysTrained;
    }

    public function setsDoneThisMonth($id)
    {
        $firstDayOfThisMonth = Carbon::now()->startOfMonth();
        $lastDayOfThisMonth = Carbon::now()->endOfMonth();

        $setsDone = Set::join('workout_exercises', 'sets.workout_exercise_id', '=', 'workout_exercises.id')
            ->join('workouts', 'workout_exercises.workout_id', '=', 'workouts.id')
            ->where('workouts.user_id', $id)
            ->whereBetween('workouts.date', [$firstDayOfThisMonth, $lastDayOfThisMonth])
            ->count();

        return $setsDone;
    }
}
