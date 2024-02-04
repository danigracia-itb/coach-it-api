<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestDay extends Model
{
    use HasFactory;

    protected $table = 'rest_days';
    protected $fillable = [
        'user_id',
        'date'
    ];

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
