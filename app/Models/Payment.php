<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $table = 'payments';
    protected $fillable = [
        'date',
        "athlete_id",
        "coach_id",
        "quantity"
    ];

    public $timestamps = false;

    public function athlete()
    {
        return $this->belongsTo(User::class, 'athlete_id');
    }

    public function coach()
    {
        return $this->belongsTo(User::class, 'coach_id');
    }
}
