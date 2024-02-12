<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trac extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'user_id',
        'leg_soreness',
        'push_soreness',
        'pull_soreness',
        'sleep_nutrition',
        'recovery',
        'motivation',
        'technical_comfort',
        'notes'
    ];

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
