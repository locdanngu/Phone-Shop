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
        Schema::create('order_product', function (Blueprint $table) {
            $table->id('idorder_product');
            $table->unsignedBigInteger('idorder');
            $table->unsignedBigInteger('idproduct');
            $table->unsignedInteger('idcategory')->nullable();
            $table->integer('quantity');
            $table->unsignedBigInteger('idcoupon')->nullable();
            $table->decimal('totalprice', 20, 2)->nullable();
            $table->decimal('beforecoupon', 20, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_product');
    }
};
