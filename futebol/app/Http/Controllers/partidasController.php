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

                    $partidaId = last(explode('/', $jogo));  //o explode divide a string jogo através da "/"  e o last pega o último

                    $temPartida = Partida::where('partida_id', $partidaId)->first(); //verifica se já tem essa partida
                    if ($temPartida) {
                        $temPartida->update([ //se tem atualiza
                            'time_casa' => $timeCasa,
                            'escudo_casa' => $escudoTimeCasa,
                            'time_fora' => $timeFora,
                            'escudo_fora' => $escudoTimeFora,

                            'status' => $status,
                            'data' => $data,
                            'hora' => $hora,
                            'jogo' => $jogo,
                            'partida_id' => $partidaId,
                        ]);
                    } else {
                        Partida::create([ //se não tem, cria
                            'time_casa' => $timeCasa,
                            'escudo_casa' => $escudoTimeCasa,
                            'time_fora' => $timeFora,
                            'escudo_fora' => $escudoTimeFora,

                            'status' => $status,
                            'data' => $data,
                            'hora' => $hora,
                            'jogo' => $jogo,
                            'partida_id' => $partidaId,
                        ]);
                    }        
                }
           }
            
           $partidas = Partida::all();
           return view('todasAsPartidas', compact('partidas')); 

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

            $partidaId = $jogo['partida_id']; 

            $partida = Partida::where('partida_id', $partidaId)->first();

            if (!$partida) {
                return response()->json(['message' => 'Partida não encontrada.'], 404);
            }
        
            $status = $jogo['status'];
            $rodada = $jogo['rodada'];
            $campeonato = $jogo['campeonato']['nome'];
            $placar = $jogo['placar'];
            $estadio = $jogo['estadio']['nome_popular'] ?? null; 
            $gols = $jogo['gols'];
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
                'partida_id' => $partida->partida_id,
                'status' => $status,
                'rodada' => $rodada,
                'placar' => $placar, 
                'gols' => json_encode($gols, true),
                'campeonato' => $campeonato,
                'estadio' => $estadio, 
                'escalacao_mandante' => json_encode($mandante_escalacao, true),
                'escalacao_visitante' => json_encode($visitante_escalacao, true),
                'cartao_amarelo_mandante' => json_encode($mandante_cartoes_amarelo, true),
                'cartao_amarelo_visitante' => json_encode($visitante_cartoes_amarelo, true),
                'cartao_vermelho_mandante' => json_encode($mandante_cartoes_vermelho, true),
                'cartao_vermelho_visitante' => json_encode($visitante_cartoes_vermelho, true),

            ]);

            return redirect()->route('partidas.show', ['id' => $partidaId]);

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

        return view('detalhes', compact('detalhes'));
    }


}






