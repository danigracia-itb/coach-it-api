<?php

namespace Database\Seeders;

use App\Models\UserData;
use App\Models\AvailableDays;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            "id" => 111111,
            "name" => "Dani Coach",
            'email' => "danicoach@gmail.com",
            'password' => Hash::make("12345678"),
            "is_coach" => true
        ]);

        DB::table('users')->insert([
            "id" => 111112,
            "name" => "Jose Antonio",
            'email' => "joseantonio@gmail.com",
            'password' => Hash::make("12345678"),
            "is_coach" => false,
            "coach_id" => 111111
        ]);

        // Crear datos de usuario de ejemplo
        $userData = UserData::create([
            'user_id' => 111112,
            'date_birth' => '1990-01-01',
            'height' => 180,
            'body_weight' => 74.5,
            'time_training' => '1 - 2 years',
            'train_available_time' => '2:30',
            'wishlist_exercises' => 'Pull Ups, Bench Press',
            'banlist_exercises' => 'Deadlift, Leg Curls',
            'short_term_goals' => 'Enjoy training',
            'long_term_goals' => 'Build a great physic',
        ]);

        // Crear días disponibles de ejemplo
        AvailableDays::create([
            'monday' => true,
            'tuesday' => false,
            'wednesday' => true,
            'thursday' => false,
            'friday' => true,
            'saturday' => false,
            'sunday' => true,
        ]);

        // Asignar días disponibles de ejemplo al usuario
        $userData->availableDays()->associate(AvailableDays::first());
        $userData->save();
    }
}
