<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todas as Partidas</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> <!-- Adicione o CSS se necessário -->
</head>
<body>
    <h1>Todas as Partidas</h1>
    <table>
        <thead>
            <tr>
                <th>Time Casa</th>
                <th>Escudo Casa</th>
                <th>Time Fora</th>
                <th>Escudo Fora</th>
                <th>Status</th>
                <th>Data</th>
                <th>Hora</th>
                <th>Link do Jogo</th>
            </tr>
        </thead>
        <tbody>
            @foreach($partidas as $partida)
                <tr>
                    <td>{{ $partida->time_casa }}</td>
                    <td><img src="{{ $partida->escudo_casa }}" alt="Escudo {{ $partida->time_casa }}" width="50"></td>
                    <td>{{ $partida->time_fora }}</td>
                    <td><img src="{{ $partida->escudo_fora }}" alt="Escudo {{ $partida->time_fora }}" width="50"></td>
                    <td>{{ $partida->status }}</td>
                    <td>{{ $partida->data ?? 'N/A' }}</td> 
                    <td>{{ $partida->hora ?? 'N/A' }}</td> 
                    <td><a href="{{ $partida->jogo }}">Ver Jogo</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
