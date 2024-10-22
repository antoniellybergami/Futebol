<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PartidasController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/partidas', [PartidasController::class, 'listarPartidas']);
Route::get('/todasPartidas', [PartidasController::class, 'index']);