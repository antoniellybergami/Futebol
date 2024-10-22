<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http; //importe da classe HTTP
use App\Models\Partida;



class partidasController extends Controller
{
    public function listarPartidas()
    {
        $token = env('FUTEBOL_API_KEY');
        $url = "https://api.api-futebol.com.br/v1/campeonatos/10/partidas"; //aqui o 10 é pq é o id que diz respeito ao brasileirão
        
        $response = Http::withHeaders([
            'Authorization' => "Bearer {$token}"
        ])->get($url);
       
        if ($response->successful()) {
           $partidas =  $response->json()['partidas']['fase-unica'];

           foreach ($partidas as $rodada => $partidasRodada) {
                foreach ($partidasRodada as $partida) {
                    $timeCasa = $partida['time_mandante']['sigla'];
                    $escudoTimeCasa = $partida['time_mandante']['escudo'];
                    $timeFora = $partida['time_visitante']['sigla'];
                    $escudoTimeFora = $partida['time_visitante']['escudo'];

                    $status = $partida['status'];
                    $data = $partida['data_realizacao']; 
                    $hora = $partida['hora_realizacao']; 
                    $jogo = $partida['_link'];

                    // Salva a partida no banco
                    Partida::create([
                        'time_casa' => $timeCasa,
                        'escudo_casa' => $escudoTimeCasa,
                        'time_fora' => $timeFora,
                        'escudo_fora' => $escudoTimeFora,

                        'status' => $status,
                        'data' => $data,
                        'hora' => $hora,
                        'jogo' => $jogo,
                    ]);
                }
           }
            
        

        } else {
            return response()->json(['status' => $response->status(), 
                                    'message' => 'Erro:',
                                    'error' => $response->body()]);
        }
    }



}



