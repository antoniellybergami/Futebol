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
            $table->foreignId('partida_id')->constrained('partidas')->onDelete('cascade');
            $table->string('placar')->nullable();
            $table->string('estadio')->nullable();

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
