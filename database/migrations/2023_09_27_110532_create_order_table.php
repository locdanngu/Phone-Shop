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
        Schema::create('order', function (Blueprint $table) {
            $table->id('idorder');
            $table->unsignedBigInteger('iduser');
            $table->enum('status', ['done', 'cancel', 'wait', 'ship', 'wait2', 'paypal']);
            $table->decimal('totalprice', 20, 2);
            $table->decimal('totalprice2', 20, 2)->nullable();
            $table->text('note')->nullable();
            $table->text('bill')->nullable();
            $table->text('reason')->nullable();
            $table->unsignedBigInteger('idcoupon')->nullable();
            $table->decimal('beforecoupon', 20, 2)->nullable();
            $table->enum('pay', ['bank', 'paypal'])->nullable();
            $table->unsignedBigInteger('idaddress')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order');
    }
};
