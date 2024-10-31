<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\Partida;
use App\Models\Detalhe;

class ColetaAutomatica extends Command
{
    protected $signature = 'partidas:coletar';
    protected $description = 'Coleta dados de partidas futuras e armazena no banco de dados';

    public function handle()
    {
        $token = env('FUTEBOL_API_KEY');
        $url = "https://api.api-futebol.com.br/v1/campeonatos/10/partidas"; 
        
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
                    $partidaId = last(explode('/', $jogo)); 

                    if (!Partida::where('partida_id', $partidaId)->exists()) {
                        Partida::create([
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
                    }
                }
            }
            $this->info('Dados coletados com sucesso.');
        } else {
            $this->error('Erro na coleta: ' . $response->status());
        }
    }
}
