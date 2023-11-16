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
            "id" => random_int(100000, 999999),
            "name" => "User Test",
            'email' => "user@gmail.com",
            'password' => Hash::make("123456"),
            "is_coach" => true
        ]);
    }
}
