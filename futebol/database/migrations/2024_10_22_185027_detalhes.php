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
        Schema::create('detalhes', function (Blueprint $table) {
            $table->id();
            $table->string('partida_id')->nullable();; 
            $table->string('rodada')->nullable();; 
            $table->string('status')->nullable(); 
            $table->string('campeonato')->nullable();; 
            $table->foreign('partida_id')->references('partida_id')->on('partidas')->onDelete('cascade'); 
            $table->string('placar')->nullable();
            $table->string('estadio')->nullable();

            $table->json('gols')->nullable();

            $table->json('escalacao_mandante')->nullable();
            $table->json('escalacao_visitante')->nullable();

            $table->json('cartao_amarelo_mandante')->nullable();
            $table->json('cartao_amarelo_visitante')->nullable();

            $table->json('cartao_vermelho_mandante')->nullable();
            $table->json('cartao_vermelho_visitante')->nullable();


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalhes');
    }
};
