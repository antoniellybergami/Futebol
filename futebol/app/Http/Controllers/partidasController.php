<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http; //importe da classe HTTP
use App\Models\Partida;
use App\Models\Detalhe;


class partidasController extends Controller
{
    public function store()
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

    public function index()
    {
        $partidas = Partida::all();
        return view('todasAsPartidas', compact('partidas')); 
    }

    public function saveDetalhes($id)
    {
        $token = env('FUTEBOL_API_KEY');
        $url = "https://api.api-futebol.com.br/v1/partidas/{$id}";

        $response = Http::withHeaders([
            'Authorization' => "Bearer {$token}"
        ])->get($url);

        if ($response->successful()) {
            $jogo = $response->json();

            $placar = $jogo['placar'];
            $estadio = $jogo['estadio'];
            $status = $jogo['status'];
            $data = $jogo['data_realizacao'] ?? null; 
            $hora = $jogo['hora_realizacao'] ?? null; 

         
            $mandante_cartoes_amarelo = $jogo['cartoes']['amarelo']['mandante'] ?? [];
            $mandante_cartoes_vermelho = $jogo['cartoes']['vermelho']['mandante'] ?? [];

            $visitante_cartoes_amarelo = $jogo['cartoes']['amarelo']['visitante'] ?? [];
            $visitante_cartoes_vermelho = $jogo['cartoes']['vermelho']['visitante'] ?? [];

           
            $mandante_escalacao = $jogo['escalacoes']['mandante'] ?? [];
            $visitante_escalacao = $jogo['escalacoes']['visitante'] ?? [];

            Detalhe::create([
                'partida_id' => $id,
                'placar' => $placar, 
                'estadio' => json_encode($estadio), 
                'escalacao_mandante' => json_encode($mandante_escalacao),
                'escalacao_visitante' => json_encode($visitante_escalacao),
                'cartao_amarelo_mandante' => json_encode($mandante_cartoes_amarelo),
                'cartao_amarelo_visitante' => json_encode($visitante_cartoes_amarelo),
                'cartao_vermelho_mandante' => json_encode($mandante_cartoes_vermelho),
                'cartao_vermelho_visitante' => json_encode($visitante_cartoes_vermelho),

            ]);

            return redirect()->route('partidas.show', ['id' => $id]);

        } else {
            return response()->json([
                'status' => $response->status(),
                'message' => 'Erro:',
                'error' => $response->body()
            ]);
        }
    }

    public function show($id)
    {
        $detalhes = Detalhe::where('partida_id', $id)->first();

        if (!$detalhes) {
            return redirect()->back()->with('error', 'Detalhes da partida não encontrados.');
        }

        return view('partida', compact('detalhes'));
    }

}






