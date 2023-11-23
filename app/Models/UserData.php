<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserData extends Model
{
    use HasFactory;

    protected $table = 'user_data';
    protected $fillable = [
        'user_id',
        'date_birth',
        'height',
        'body_weight',
        'time_training',
        'train_available_time',
        'available_days',
        'wishlist_exercises',
        'banlist_exercises',
        'short_term_goals',
        'long_term_goals',
    ];

    // Relación con la tabla 'users'
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relación con la tabla 'available_days'
    public function availableDays()
    {
        return $this->belongsTo(AvailableDays::class, 'available_days');
    }
}
