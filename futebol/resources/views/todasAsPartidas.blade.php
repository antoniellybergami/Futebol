<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todas as Partidas</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> <!-- Adicione o CSS se necessário -->
    <style>
        /* Estilos para a tabela */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 10px; /* Espaçamento interno */
            text-align: left;
            border-bottom: 1px solid #ddd; /* Linha de separação entre as linhas */
        }

        /* Estilo para espaçamento entre escudos e nomes */
        .partida {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .escudo {
            margin: 0 10px; /* Margem horizontal para espaçamento */
        }
    </style>
</head>
<body>
    <h1>Todas as Partidas</h1>
    <table>
        <thead>
            <tr>
                <th>Partida</th>
                <th>Status</th>
                <th>Data</th>
                <th>Hora</th>
                <th>Link do Jogo</th>
            </tr>
        </thead>
        <tbody>
            @foreach($partidas as $partida)
                <tr>
                    <td class="partida">
                        <img class="escudo" src="{{ $partida->escudo_casa }}" alt="Escudo {{ $partida->time_casa }}" width="30"> 
                        {{ $partida->time_casa }} X {{ $partida->time_fora }} 
                        <img class="escudo" src="{{ $partida->escudo_fora }}" alt="Escudo {{ $partida->time_fora }}" width="30">
                    </td>
                    <td>{{ $partida->status }}</td>
                    <td>{{ $partida->data ?? 'N/A' }}</td> 
                    <td>{{ $partida->hora ?? 'N/A' }}</td> 
                    <td><a href="{{ route('partidas.saveDetalhes', $partida->partida_id) }}">Ver Detalhes do Jogo</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
