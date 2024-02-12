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
        Schema::create('tracs', function (Blueprint $table) {
            $table->id();
            $table->date("date")->default(today());

            $table->unsignedBigInteger('user_id');
            // Soreness fields
            $table->integer('leg_soreness');
            $table->integer('push_soreness');
            $table->integer('pull_soreness');
            // Recovery fields
            $table->integer('sleep_nutrition');
            $table->integer('recovery');
            // After workout fields
            $table->integer('motivation')->nullable();
            $table->integer('technical_comfort')->nullable();
            // Notes field
            $table->text('notes')->nullable();

            // Define foreign key constraint
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tracs');
    }
};
