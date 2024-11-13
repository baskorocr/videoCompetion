<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idKarya');
            $table->string('idNPK');
            $table->integer('total_amount');
            $table->string('reference');
            $table->string("merchant_reference");

            $table->foreign('idKarya')->references('id')->on('karyas')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('idNPK')->references('npk')->on('users')->onUpdate('cascade')->onDelete('cascade');

            $table->enum('status', ['paid', 'unpaid'])->default('unpaid');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};