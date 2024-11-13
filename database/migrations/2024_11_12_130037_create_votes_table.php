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
        Schema::create('votes', function (Blueprint $table) {
            $table->id();
            $table->string('idNPK');
            $table->unsignedBigInteger('idKarya');

            $table->foreign('idNPK')->references('npk')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('idKarya')->references('id')->on('karyas')->onDelete('cascade')->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('votes');
    }
};