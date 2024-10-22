<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Partida extends Model
{
    use HasFactory;

    protected $fillable = [
        'time_casa',
        'escudo_casa',
        'time_fora',
        'escudo_fora',

        'status',
        'data',
        'hora',
        'jogo'
    ];
}

