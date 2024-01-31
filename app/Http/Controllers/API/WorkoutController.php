<?php

namespace App\Http\Controllers\API;

use App\Models\Set;
use App\Models\Workout;
use Illuminate\Http\Request;
use App\Models\WorkoutExercise;
use Illuminate\Support\Facades\DB;
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
            foreach ($exercise["sets"] as $set) {
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
        $workout = [];

        $workoutExercises = DB::table("workouts")
            ->where("workouts.id", "=",  $id)
            ->join("workout_exercises", "workouts.id", "=", "workout_exercises.workout_id")
            ->join("exercises", "workout_exercises.exercise_id", "=", "exercises.id")
            ->orderBy("workout_exercises.order")
            ->select(["workouts.date", "workout_exercises.*", "exercises.*", "workout_exercises.id"])->get();

        foreach ($workoutExercises as $exercise) {
            $sets = DB::table("sets")->where("sets.workout_exercise_id", "=", $exercise->id)->select("*")->get();
            $exercise->sets = $sets;

            array_push($workout, $exercise);
        }

        // $workout = Workout::with('exercises', 'workout_exercises.sets')->find($id);

        return $workout;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $workout = Workout::find($id);

        $workout->workout_exercises()->delete();

        $count = 1;
        foreach ($request->workout as $exercise) {
            $workoutExercise = WorkoutExercise::create([
                'order' => $count,
                'workout_id' => $workout->id,
                'exercise_id' => $exercise["exercise_id"]
            ]);

            // Guardar series
            foreach ($exercise["sets"] as $set) {
                Set::create([
                    'workout_exercise_id' => $workoutExercise->id,
                    'actual_weight' => $set["actual_weight"],
                    'actual_reps' => $set["actual_reps"],
                    'actual_rpe' => $set["actual_rpe"],
                    'target_weight' => $set["target_weight"],
                    'target_reps' => $set["target_reps"],
                    'target_rpe' => $set["target_rpe"]
                ]);
            }

            $count++;
        }

        return $workout;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $workout = Workout::find($id);
        $workout->delete();
        return "success";
    }
}
