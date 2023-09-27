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
        Schema::create('product', function (Blueprint $table) {
            $table->id('idproduct');
            $table->string('nameproduct', 200);
            $table->decimal('oldprice', 20, 2)->nullable();
            $table->decimal('price', 20, 2);
            $table->text('detail');
            $table->string('imageproduct', 200);
            $table->timestamp('timedelete')->nullable();
            $table->unsignedBigInteger('idcategory');
            $table->unsignedBigInteger('idtype');
            $table->unsignedBigInteger('sold');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product');
    }
};
