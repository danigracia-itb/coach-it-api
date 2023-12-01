<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workout extends Model
{
    use HasFactory;

    protected $table = 'workouts';
    protected $fillable = [
        'user_id',
        'date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function exercises()
    {
        return $this->hasMany(WorkoutExercise::class, 'workout_id');
    }
}
