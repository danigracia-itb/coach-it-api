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
        Schema::create('default_exercises', function (Blueprint $table) {
            $table->id();
            $table->string("name");

            //1: Push | 2: Pull | 3: Leg | 4: Core
            $table->integer("muscular_group");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('default_exercises');
    }
};
