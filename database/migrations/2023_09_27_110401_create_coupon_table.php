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
        Schema::create('coupon', function (Blueprint $table) {
            $table->id('idcoupon');
            $table->string('code', 20)->index();
            $table->timestamp('starttime');
            $table->timestamp('endtime')->nullable();
            $table->enum('applicable_to', ['cart', 'product']);
            $table->unsignedBigInteger('iduser')->nullable();
            $table->tinyInteger('product_list');
            $table->enum('discount_type', ['percentage', 'amount']);
            $table->unsignedBigInteger('minimum_order_amount');
            $table->unsignedBigInteger('max_discount_amount');
            $table->unsignedBigInteger('discount_amount');
            $table->unsignedBigInteger('used');
            $table->tinyInteger('isdelete');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupon');
    }
};
