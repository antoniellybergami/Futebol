<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PartidasController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/partidas', [PartidasController::class, 'store']);
Route::get('/todasPartidas', [PartidasController::class, 'index'])->name('partidas.index');

Route::get('/partidas/{id}', [partidasController::class, 'saveDetalhes'])->name('partidas.saveDetalhes');
Route::get('/partida/{id}', [PartidasController::class, 'show'])->name('partidas.show');

