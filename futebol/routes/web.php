<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/partidas/{time}', function ($time) {
    $token = env('SPORTMONKS_API_KEY');
    $url = "https://soccer.sportmonks.com/api/v2.0/fixtures/by_team/{$time}?api_token={$token}
";

    $response = Http::get($url);

    if ($response->successful()) {
        return $response->json();
    }

    return [
        'status' => $response->status(),
        'message' => 'Erro ao buscar dados',
        'error' => $response->body()
    ];
});
