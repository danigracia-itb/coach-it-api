<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DefaultExercisesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $exerciseArray = [
            [
                "name" => "Push-Up",
                "muscular_group" => 1
            ],
            [
                "name" => "Pull-Up",
                "muscular_group" => 2
            ],
            [
                "name" => "Squat",
                "muscular_group" => 3
            ],
            [
                "name" => "Bench Press",
                "muscular_group" => 1
            ],
            [
                "name" => "Deadlift",
                "muscular_group" => 2
            ],
            [
                "name" => "Leg Press",
                "muscular_group" => 3
            ],
            [
                "name" => "Dumbbell Curl",
                "muscular_group" => 2
            ],
            [
                "name" => "Lat Pulldown",
                "muscular_group" => 2
            ],
            [
                "name" => "Leg Curl",
                "muscular_group" => 3
            ],
            [
                "name" => "Tricep Dip",
                "muscular_group" => 2
            ],
            [
                "name" => "Chest Fly",
                "muscular_group" => 1
            ],
            [
                "name" => "Russian Twist",
                "muscular_group" => 4
            ],
            [
                "name" => "Leg Extension",
                "muscular_group" => 3
            ],
            [
                "name" => "Hammer Curl",
                "muscular_group" => 2
            ],
            [
                "name" => "Seated Row",
                "muscular_group" => 2
            ],
            [
                "name" => "Calf Raise",
                "muscular_group" => 3
            ],
            [
                "name" => "Skull Crushers",
                "muscular_group" => 2
            ],
            [
                "name" => "Incline Bench Press",
                "muscular_group" => 1
            ],
            [
                "name" => "Plank",
                "muscular_group" => 4
            ],
            [
                "name" => "Leg Raise",
                "muscular_group" => 3
            ],
            [
                "name" => "Preacher Curl",
                "muscular_group" => 2
            ],
            [
                "name" => "T-Bar Row",
                "muscular_group" => 2
            ],
            [
                "name" => "Lunges",
                "muscular_group" => 3
            ],
            [
                "name" => "Tricep Kickbacks",
                "muscular_group" => 2
            ],
            [
                "name" => "Pulldown",
                "muscular_group" => 2
            ],
            [
                "name" => "Step-Ups",
                "muscular_group" => 3
            ],
            [
                "name" => "Bicep Curls",
                "muscular_group" => 2
            ],
            [
                "name" => "Bent-Over Rows",
                "muscular_group" => 2
            ],
        ];


        foreach ($exerciseArray as $exercise) {
            DB::table('default_exercises')->insert([
                'name' => $exercise["name"],
                'muscular_group' => $exercise["muscular_group"],
            ]);
        }
    }
}
