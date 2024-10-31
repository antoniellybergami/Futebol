<div class="container">
    @php    
        $gols = json_decode($detalhes->gols);
        $escalacaoMandante = json_decode($detalhes->escalacao_mandante);
        $escalacaoVisitante = json_decode($detalhes->escalacao_visitante);
        $cartoesAmarelosMandante = json_decode($detalhes->cartao_amarelo_mandante);
        $cartoesAmarelosVisitante = json_decode($detalhes->cartao_amarelo_visitante);
        $cartoesVermelhosMandante = json_decode($detalhes->cartao_vermelho_mandante);
        $cartoesVermelhosVisitante = json_decode($detalhes->cartao_vermelho_visitante);
    @endphp

    <h1 class="titulo">Detalhes da Partida</h1>

    <h2 class="placar">{{ $detalhes->placar ?? 'Informações não disponíveis' }}</h2>
    <h3 class="subtitulo"> {{ $detalhes->campeonato ?? 'Informações não disponíveis' }}</h3>
    <h3 class="subtitulo">Estádio: {{ $detalhes->estadio ?? 'Informações não disponíveis' }}</h3>
    <h3 class="subtitulo">Status: {{ $detalhes->status ?? 'Informações não disponíveis' }}</h3>
    <h3 class="subtitulo">Rodada: {{ $detalhes->rodada ?? 'Informações não disponíveis' }}</h3>

    <div class="info-time">
        <h3>Informações do Time Mandante</h3>

        <h4>Gols do Mandante:</h4>
        <ul>
            @if (!empty($gols->mandante))
                @foreach ($gols->mandante as $gol)
                    <li>{{ $gol->atleta->nome_popular ?? 'Informações não disponíveis' }} - minuto {{ $gol->minuto ?? 'Informações não disponíveis' }}</li>
                @endforeach
            @else
                <li>Sem gols</li>
            @endif
        </ul>
        
        <h4>Escalação Tática: {{ $escalacaoMandante->esquema_tatico ?? 'Informações não disponíveis' }}</h4>
        <h4>Técnico: {{ $escalacaoMandante->tecnico->nome_popular ?? 'Informações não disponíveis' }}</h4>

        <h3>Escalação Mandante:</h3>
        <h5>Jogadores Escalados:</h5>
        <ul>
            @if (!empty($escalacaoMandante->titulares))
                @foreach ($escalacaoMandante->titulares as $jogador)
                    <li>{{ $jogador->camisa ?? 'Sem Camisa' }} - {{ $jogador->atleta->nome_popular ?? 'Sem Nome' }}: {{ $jogador->posicao->nome ?? 'Sem Posição' }}</li>
                @endforeach
            @else
                <li>Informações não disponíveis</li>
            @endif
        </ul>

        <h5>Reservas:</h5>
        <ul>
            @if (!empty($escalacaoMandante->reservas))
                @foreach ($escalacaoMandante->reservas as $jogador)
                    <li>{{ $jogador->camisa ?? 'Sem Camisa' }} - {{ $jogador->atleta->nome_popular ?? 'Sem Nome' }}: {{ $jogador->posicao->nome ?? 'Sem Posição' }}</li>
                @endforeach
            @else
                <li>Informações não disponíveis</li>
            @endif
        </ul>

        <h3>Cartões Amarelos (Mandante):</h3>
        <ul>
            @if (!empty($cartoesAmarelosMandante))
                @foreach ($cartoesAmarelosMandante as $cartao)
                    <li>{{ $cartao->atleta->nome_popular ?? 'Nome não disponível' }} - minuto {{ $cartao->minuto ?? 'Minuto não disponível' }}</li>
                @endforeach
            @else
                <li>Não há cartões amarelos registrados</li>
            @endif
        </ul>

        <h3>Cartões Vermelhos (Mandante):</h3>
        <ul>
            @if (!empty($cartoesVermelhosMandante))
                @foreach ($cartoesVermelhosMandante as $cartao)
                    <li>{{ $cartao->atleta->nome_popular ?? 'Nome não disponível' }} - minuto {{ $cartao->minuto ?? 'Minuto não disponível' }}</li>
                @endforeach
            @else
                <li>Não há cartões vermelhos registrados</li>
            @endif
        </ul>
    </div>

    <div class="info-time">
        <h3>Informações Visitantes</h3>

        <h4>Gols do Visitante:</h4>
        <ul>
            @if (!empty($gols->visitante))
                @foreach ($gols->visitante as $gol)
                    <li>{{ $gol->atleta->nome_popular ?? 'Nome não disponível' }} - minuto {{ $gol->minuto ?? 'Minuto não disponível' }}</li>
                @endforeach
            @else
                <li>Não há gols registrados para o visitante.</li>
            @endif
        </ul>

        <h3>Escalação Visitante:</h3>
        <h4>Escalação Tática: {{ $escalacaoVisitante->esquema_tatico ?? 'Informações não disponíveis' }}</h4>
        <h4>Técnico: {{ $escalacaoVisitante->tecnico->nome_popular ?? 'Informações não disponíveis' }}</h4>

        <h5>Jogadores Escalados:</h5>
        <ul>
            @if (!empty($escalacaoVisitante->titulares))
                @foreach ($escalacaoVisitante->titulares as $jogador)
                    <li>{{ $jogador->camisa ?? 'Sem Camisa' }} - {{ $jogador->atleta->nome_popular ?? 'Sem Nome' }}: {{ $jogador->posicao->nome ?? 'Sem Posição' }}</li>
                @endforeach
            @else
                <li>Informações não disponíveis</li>
            @endif
        </ul>

        <h5>Reservas:</h5>
        <ul>
            @if (!empty($escalacaoVisitante->reservas))
                @foreach ($escalacaoVisitante->reservas as $jogador)
                    <li>{{ $jogador->camisa ?? 'Sem Camisa' }} - {{ $jogador->atleta->nome_popular ?? 'Sem Nome' }}: {{ $jogador->posicao->nome ?? 'Sem Posição' }}</li>
                @endforeach
            @else
                <li>Informações não disponíveis</li>
            @endif
        </ul>

        <h3>Cartões Amarelos (Visitante):</h3>
        <ul>
            @if (!empty($cartoesAmarelosVisitante))
                @foreach ($cartoesAmarelosVisitante as $cartao)
                    <li>{{ $cartao->atleta->nome_popular ?? 'Nome não disponível' }} - minuto {{ $cartao->minuto ?? 'Minuto não disponível' }}</li>
                @endforeach
            @else
                <li>Não há cartões amarelos registrados</li>
            @endif
        </ul>

        <h3>Cartões Vermelhos (Visitante):</h3>
        <ul>
            @if (!empty($cartoesVermelhosVisitante))
                @foreach ($cartoesVermelhosVisitante as $cartao)
                    <li>{{ $cartao->atleta->nome_popular ?? 'Nome não disponível' }} - minuto {{ $cartao->minuto ?? 'Minuto não disponível' }}</li>
                @endforeach
            @else
                <li>Não há cartões vermelhos registrados</li>
            @endif
        </ul>
    </div>
</div>

<style>
    .container {
        margin: 0 auto;
        padding: 20px;
    }

    .titulo {
        text-align: center;
    }

    .subtitulo {
        color: #555;
    }

    .placar {
        font-size: 1.5em;
        color: red; 
        text-align: center;
    }

    .info-time {
        margin-bottom: 20px; 
        padding: 15px;
        border: 2px solid #ddd;
    }
