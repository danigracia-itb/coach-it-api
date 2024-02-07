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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->date("date")->default(today());

            $table->unsignedBigInteger("athlete_id");
            $table->foreign('athlete_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger("coach_id");
            $table->foreign('coach_id')->references('id')->on('users')->onDelete('cascade');
            $table->float("quantity");

            $table->enum('payment_type', ['monthly', 'quarterly', 'annual'])->default("monthly")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
