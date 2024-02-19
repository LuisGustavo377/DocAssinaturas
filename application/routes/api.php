<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CidadesController;
use App\Http\Controllers\AdminAuth\PessoaFisicaController;
use App\Http\Controllers\AdminAuth\PessoaJuridicaController;
use App\Models\PessoaFisica;
use App\Models\PessoaJuridica;

//ROTAS PARA CIDADES
Route::get('/api/cidades/{estado_id}', [CidadesController::class, 'getCidadesPorEstado']);


//ROTAS PARA PESSOAS
Route::get('/api/pessoafisica/{pessoa_id}', [PessoaFisicaController::class, 'getPessoaFisica']);
Route::get('/api/pessoajuridica/{pessoa_id}', [PessoaJuridicaController::class, 'getPessoaJuridica']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
