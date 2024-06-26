<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    use HasFactory;

    protected $table = 'exercises';

    protected $fillable = ['name', 'muscular_group', 'is_default', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
