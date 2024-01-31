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
        return $this->belongsTo(Exercise::class, 'exercise_id');
    }

    public function sets()
    {
        return $this->hasMany(Exercise::class, 'workout_exercise_id', "id");
    }
}
