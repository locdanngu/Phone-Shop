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
        Schema::create('admin', function (Blueprint $table) {
            $table->id('idadmin');
            $table->text('name');
            $table->string('adminname', 50);
            $table->string('password', 100);
            $table->string('role', 20);
            $table->tinyInteger('product');
            $table->tinyInteger('coupon');
            $table->tinyInteger('user');
            $table->tinyInteger('order');
            $table->tinyInteger('revenue');
            $table->tinyInteger('contact');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin');
    }
};
