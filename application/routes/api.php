<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CidadesController;
use App\Http\Controllers\AdminAuth\PessoaFisicaController;
use App\Http\Controllers\AdminAuth\PessoaJuridicaController;
use App\Models\PessoaFisica;

//ROTAS PARA CIDADES
Route::get('/api/cidades/{estado_id}', [CidadesController::class, 'getCidadesPorEstado']);


//ROTAS PARA PESSOA
Route::get('/api/pessoafisica/{pessoa_id}', [PessoaFisicaController::class, 'getPessoaFisica']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
