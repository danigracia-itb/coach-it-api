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
        // Primera migración
        Schema::create('users', function (Blueprint $table) {
            $table->unsignedInteger('id')->primary()->unique()->length(6);
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->boolean("is_coach")->default(false);

            $table->unsignedInteger("coach_id")->length(6)->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        // Segunda migración
        Schema::table('users', function (Blueprint $table) {
            $table->foreign("coach_id")->references("id")->on("users")->onDelete('set null')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
