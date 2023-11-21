<?php

namespace Database\Seeders;

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
            "name" => "Coach Test",
            'email' => "coach@gmail.com",
            'password' => Hash::make("12345678"),
            "is_coach" => true
        ]);

        DB::table('users')->insert([
            "id" => random_int(100000, 999999),
            "name" => "Athlete 1",
            'email' => "athlete1@gmail.com",
            'password' => Hash::make("12345678"),
            "is_coach" => false,
            "coach_id" => 111111
        ]);

        DB::table('users')->insert([
            "id" => random_int(100000, 999999),
            "name" => "Athlete 2",
            'email' => "athlete2@gmail.com",
            'password' => Hash::make("12345678"),
            "is_coach" => false,
            "coach_id" => 111111
        ]);

        DB::table('users')->insert([
            "id" => random_int(100000, 999999),
            "name" => "Athlete 3",
            'email' => "athlete3@gmail.com",
            'password' => Hash::make("12345678"),
            "is_coach" => false,
            "coach_id" => 111111
        ]);
    }
}
