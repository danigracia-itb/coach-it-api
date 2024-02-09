<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sets', function (Blueprint $table) {
            $table->id();
            $table->foreignId("workout_exercise_id")->constrained()->onDelete("cascade");

            $table->integer("target_reps")->nullable();
            $table->float("target_weight", 4 , 2)->nullable();
            $table->float("target_rpe", 2, 1)->nullable();

            $table->integer("actual_reps")->nullable();
            $table->float("actual_weight", 4 , 2)->nullable();
            $table->float("actual_rpe", 2, 1)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sets');
    }
};
