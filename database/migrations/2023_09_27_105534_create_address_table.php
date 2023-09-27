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
        Schema::create('addresse', function (Blueprint $table) {
            $table->id('idaddress');
            $table->unsignedBigInteger('iduser');
            $table->string('state_country', 100)->nullable();
            $table->string('country', 100);
            $table->string('town_city', 100);
            $table->string('address', 200);
            $table->string('companyname', 100)->nullable();
            $table->unsignedInteger('postcode');
            $table->string('apartment', 100)->nullable();
            $table->string('ordernote', 100)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('address');
    }
};
