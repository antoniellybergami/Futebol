<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detalhe extends Model
{
    use HasFactory;

    protected $fillable = [
        'partida_id',
        'placar',
        'estadio',
        'rodada',
        'status',
        'campeonato',

        'gols',

        'escalacao_mandante',
        'escalacao_visitante',

        'cartao_amarelo_mandante',
        'cartao_amarelo_visitante',
        
        'cartao_vermelho_mandante',
        'cartao_vermelho_visitante',
    ];
}
