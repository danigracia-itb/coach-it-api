<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkoutExercise extends Model
{
    use HasFactory;

    protected $table = 'workout_exercises';
    protected $fillable = [
        'order',
        'workout_id',
        'exercise_id'
    ];

    public $timestamps = false;

    public function workout()
    {
        return $this->belongsTo(Workout::class, 'workout_id');
    }

    public function exercise()
    {
        return $this->hasOne(Exercise::class, 'exercise_id');
    }
}
