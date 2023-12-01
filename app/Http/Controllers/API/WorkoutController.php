<?php

namespace App\Http\Controllers\API;

use App\Models\Set;
use App\Models\Workout;
use Illuminate\Http\Request;
use App\Models\WorkoutExercise;
use App\Http\Controllers\Controller;

class WorkoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //TODO: VALIDAR

        $workout = Workout::create([
            'user_id' => $request->user_id,
            'date' => $request->date
        ]);

        $count = 1;
        foreach ($request->workout as $exercise) {
            $workoutExercise = WorkoutExercise::create([
                'order' => $count,
                'workout_id' => $workout->id,
                'exercise_id' => $exercise["id"]
            ]);

            //Guardar series
            foreach($exercise["sets"] as $set) {
                Set::create([
                    'workout_exercise_id' => $workoutExercise->id,
                    'target_weight' => $set["weight"],
                    'target_reps' => $set["reps"],
                    'target_rpe' => $set["rpe"]
                ]);
            }

            $count++;
        };

        return $workout;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
