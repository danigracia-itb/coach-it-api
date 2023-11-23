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
        Schema::create('user_data', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id");
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');

            //P1
            $table->date("date_birth");
            $table->integer("height"); //cm
            $table->float("body_weight", 5, 2);

            //P2
            $table->enum('time_training', ['0 - 6 months', '6 months - 1 year', '1 - 2 years', '+2 years']);
            $table->time("train_available_time");

            //Days
            $table->unsignedBigInteger('available_days')->nullable();
            $table->foreign('available_days')->references('id')->on('available_days')->onDelete('set null');

            //P3
            $table->text("wishlist_exercises");
            $table->text("banlist_exercises");

            //P4
            $table->text("short_term_goals");
            $table->text("long_term_goals");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_data');
    }
};
