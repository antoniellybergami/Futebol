<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()

    {
        Schema::create('partidas', function (Blueprint $table) {
            $table->id();
            $table->string('time_casa');
            $table->string('escudo_casa');
            $table->string('time_fora');
            $table->string('escudo_fora');

            $table->string('status');
            $table->string('data')->nullable();
            $table->string('hora')->nullable();
            $table->string('jogo');
            $table->string('partida_id')->unique();
          
           
            $table->timestamps();
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
