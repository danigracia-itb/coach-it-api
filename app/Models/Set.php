<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Set extends Model
{
    use HasFactory;

    protected $table = 'sets';
    protected $fillable = [
        'workout_exercise_id',

        "target_reps",
        "target_weight",
        "target_rpe",

        "actual_reps",
        "actual_weight",
        "actual_rpe"
    ];

    public $timestamps = false;

    public function exercise()
    {
        return $this->belongsTo(WorkoutExercise::class, 'workout_exercise_id');
    }
}
