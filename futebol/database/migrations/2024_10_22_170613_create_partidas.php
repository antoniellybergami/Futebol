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
            $table->string('time_fora');
            $table->integer('placar_casa')->nullable();
            $table->integer('placar_fora')->nullable();
            $table->dateTime('data_hora');
            $table->string('estadio');
            $table->string('campeonato');
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
