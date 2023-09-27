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
        Schema::create('user', function (Blueprint $table) {
            $table->id('iduser');
            $table->string('username', 50);
            $table->string('password', 100);
            $table->string('firstname', 20);
            $table->string('lastname', 20);
            $table->string('email', 50)->unique();
            $table->string('phone', 11)->unique();
            $table->enum('status', ['ok', 'lock']);
            $table->timestamps();
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
