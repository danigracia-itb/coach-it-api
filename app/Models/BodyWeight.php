<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BodyWeight extends Model
{
    use HasFactory;

    protected $table = 'body_weights';
    protected $fillable = [
        'date',
        "value",
        "user_id"
    ];

    public $timestamps = false;

    public function athlete()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
