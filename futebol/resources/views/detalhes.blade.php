<!DOCTYPE html>
<html>
<head>
    <title>Detalhes da Partida</title>
</head>
<body>
    <h1>Detalhes da Partida</h1>

    <h2>Placar: {{ $detalhes->placar }}</h2>
    <h3>Estádio: {{ $detalhes->estadio }}</h3>
    <h3>Status: {{ $detalhes->status }}</h3>
    <h3>Data: {{ $detalhes->data }}</h3>
    <h3>Hora: {{ $detalhes->hora }}</h3>

    <h3>Escalação Mandante:</h3>
    <pre>{{ json_encode(json_decode($detalhes->escalacao_mandante), JSON_PRETTY_PRINT) }}</pre>

    <h3>Escalação Visitante:</h3>
    <pre>{{ json_encode(json_decode($detalhes->escalacao_visitante), JSON_PRETTY_PRINT) }}</pre>

    <h3>Cartões Amarelos (Mandante):</h3>
    <pre>{{ json_encode(json_decode($detalhes->cartao_amarelo_mandante), JSON_PRETTY_PRINT) }}</pre>

    <h3>Cartões Amarelos (Visitante):</h3>
    <pre>{{ json_encode(json_decode($detalhes->cartao_amarelo_visitante), JSON_PRETTY_PRINT) }}</pre>

    <h3>Cartões Vermelhos (Mandante):</h3>
    <pre>{{ json_encode(json_decode($detalhes->cartao_vermelho_mandante), JSON_PRETTY_PRINT) }}</pre>

    <h3>Cartões Vermelhos (Visitante):</h3>
    <pre>{{ json_encode(json_decode($detalhes->cartao_vermelho_visitante), JSON_PRETTY_PRINT) }}</pre>

    <a href="{{ route('partidas.index') }}">Voltar para a lista de partidas</a>
</body>
</html>
