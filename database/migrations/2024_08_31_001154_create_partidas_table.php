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
        Schema::create('partidas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idJogador');
            $table->timestamps();
            $table->string('localPart');
            $table->string('resultPart');
        });

        Schema::table('partidas', function (Blueprint $table) {
            $table->foreign('idJogador')->references('id')->on('users')->onDelete('cascade');    
        });
    }
 
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partidas');
    }
};
