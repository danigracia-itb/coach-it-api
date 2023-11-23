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
        Schema::create('exercises', function (Blueprint $table) {
            $table->id();
            $table->string('name');

            //1: Push | 2: Pull | 3: Leg | 4: Core
            $table->integer("muscular_group");


            $table->boolean('is_default')->default(true); // Identificar si es un ejercicio por defecto
            $table->foreignId('user_id')->nullable()->constrained(); // Relación con la tabla de usuarios (puede ser nulo para ejercicios por defecto)

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exercises');
    }
};
