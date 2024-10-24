<div class="container">

    @php    
        $gols = json_decode($detalhes->gols);
    @endphp
    
    <h1>Detalhes da Partida</h1>

    <h3>Rodada: {{ $detalhes->campeonato ?? 'Informações não disponíveis' }}</h3>
    <h2>Placar: {{ $detalhes->placar ?? 'Informações não disponíveis' }}</h2>
    <h3>Estádio: {{ $detalhes->estadio ?? 'Informações não disponíveis' }}</h3>
    <h3>Status: {{ $detalhes->status ?? 'Informações não disponíveis' }}</h3>
    <h3>Rodada: {{ $detalhes->rodada ?? 'Informações não disponíveis' }}</h3>


    <h3>Informações do Time Mandante</h3>
  
    <h4>Gols do Mandante:</h4>
    <ul>
        @if (!empty($gols->mandante))
            @foreach ($gols->mandante as $gol)
                <li>{{ $gol->atleta->nome_popular ?? 'Informações não disponíveis' }} minuto {{ $gol->minuto ?? 'Informações não disponíveis' }}</li>
            @endforeach
        @else
            <li>Sem gols</li>
        @endif
    </ul>
    
    @php
        $escalacaoMandante = json_decode($detalhes->escalacao_mandante);
    @endphp
    <h4>Escalação Tática: {{ $escalacaoMandante->esquema_tatico ?? 'Informações não disponíveis ainda' }}</h4>
    <h4>Técnico: {{ $escalacaoMandante->tecnico->nome_popular ?? 'Informações não disponíveis ainda' }}</h4>

    <h3>Escalação Mandante:</h3>
    <h5>Jogadores Escalados:</h5>
    <ul>
        @if ($escalacaoMandante && isset($escalacaoMandante->titulares))
            @foreach ($escalacaoMandante->titulares as $jogador)
                <li>{{ $jogador->camisa }} - {{ $jogador->atleta->nome_popular }}: {{ $jogador->posicao->nome ?? 'Sem Posição' }}</li>
            @endforeach
        @else
            <li>Informações não disponíveis</li>
        @endif
    </ul>

    <h5>Reservas:</h5>
    <ul>
        @if ($escalacaoMandante && isset($escalacaoMandante->reservas))
            @foreach ($escalacaoMandante->reservas as $jogador)
                <li>{{ $jogador->camisa }} - {{ $jogador->atleta->nome_popular }}: {{ $jogador->posicao->nome ?? 'Sem Posição' }}</li>
            @endforeach
        @else
            <li>Informações não disponíveis</li>
        @endif
    </ul>

    <h3>Cartões Amarelos (Mandante):</h3>
    <ul>
        @php
            $cartoesAmarelosMandante = json_decode($detalhes->cartao_amarelo_mandante);
        @endphp
        @if ($cartoesAmarelosMandante && count($cartoesAmarelosMandante) > 0)
            @foreach ($cartoesAmarelosMandante as $cartao)
                <li>{{ $cartao->atleta->nome_popular ?? 'Nome não disponível' }}</li>
            @endforeach
        @else
            <li>Não há cartões amarelos registrados</li>
        @endif
    </ul>

    <h3>Cartões Amarelos (Visitante):</h3>
    <ul>
        @php
            $cartoesAmarelosVisitante = json_decode($detalhes->cartao_amarelo_visitante);
        @endphp
        @if ($cartoesAmarelosVisitante && count($cartoesAmarelosVisitante) > 0)
            @foreach ($cartoesAmarelosVisitante as $cartao)
                <li>{{ $cartao->atleta->nome_popular ?? 'Nome não disponível' }}</li>
            @endforeach
        @else
            <li>Não há cartões amarelos registrados</li>
        @endif
    </ul>

    <h3>Cartões Vermelhos (Mandante):</h3>
    <ul>
        @php
            $cartoesVermelhosMandante = json_decode($detalhes->cartao_vermelho_mandante);
        @endphp
        @if ($cartoesVermelhosMandante && count($cartoesVermelhosMandante) > 0)
            @foreach ($cartoesVermelhosMandante as $cartao)
                <li>{{ $cartao->atleta->nome_popular ?? 'Nome não disponível' }}</li>
            @endforeach
        @else
            <li>Não há cartões vermelhos registrados</li>
        @endif
    </ul>

    <h3>Informações Visitantes</h3>

    <h4>Gols do Visitante:</h4>
    <ul>
        @if (!empty($gols->visitante))
            @foreach ($gols->visitante as $gol)
                <li>{{ $gol->atleta->nome_popular ?? 'Nome não disponível' }} minuto {{ $gol->minuto ?? 'Minuto não disponível' }}</li>
            @endforeach
        @else
            <li>Não há gols registrados para o visitante.</li>
        @endif
    </ul>


    <h3>Escalação Visitante:</h3>
    @php
        $escalacaoVisitante = json_decode($detalhes->escalacao_visitante);
    @endphp
    <h4>Escalação Tática: {{ $escalacaoVisitante->esquema_tatico ?? 'Informações não disponíveis' }}</h4>
    <h4>Técnico: {{ $escalacaoVisitante->tecnico->nome_popular ?? 'Informações não disponíveis' }}</h4>
    
    <h5>Jogadores Escalados:</h5>
    <ul>
        @if ($escalacaoVisitante && isset($escalacaoVisitante->titulares))
            @foreach ($escalacaoVisitante->titulares as $jogador)
                <li>{{ $jogador->camisa }} - {{ $jogador->atleta->nome_popular }}: {{ $jogador->posicao->nome ?? 'Sem Posição' }}</li>
            @endforeach
        @else
            <li>Informações não disponíveis</li>
        @endif
    </ul>

    <h5>Reservas:</h5>
    <ul>
        @if ($escalacaoVisitante && isset($escalacaoVisitante->reservas))
            @foreach ($escalacaoVisitante->reservas as $jogador)
                <li>{{ $jogador->camisa }} - {{ $jogador->atleta->nome_popular }}: {{ $jogador->posicao->nome ?? 'Sem Posição' }}</li>
            @endforeach
        @else
            <li>Informações não disponíveis</li>
        @endif
    </ul>

    <h3>Cartões Vermelhos (Visitante):</h3>
    <ul>
        @php
            $cartoesVermelhosVisitante = json_decode($detalhes->cartao_vermelho_visitante);
        @endphp
        @if ($cartoesVermelhosVisitante && count($cartoesVermelhosVisitante) > 0)
            @foreach ($cartoesVermelhosVisitante as $cartao)
                <li>{{ $cartao->atleta->nome_popular ?? 'Nome não disponível' }}</li>
            @endforeach
        @else
            <li>Não há cartões vermelhos registrados</li>
        @endif
    </ul>
</div>
