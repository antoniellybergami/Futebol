<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http; //importe da classe HTTP


class partidasController extends Controller
{
    public function listarPartidas()
    {
        $token = env('FUTEBOL_API_KEY');
        $url = "https://api.api-futebol.com.br/v1/campeonatos/10/partidas";
        
        $response = Http::withHeaders([
            'Authorization' => "Bearer {$token}"
        ])->get($url);
       
        if ($response->successful()) {
            return response()->json($response->json());
        

        } else {
            return response()->json(['status' => $response->status(), 
                                    'message' => 'Erro:',
                                    'error' => $response->body()]);
        }
    }



}



