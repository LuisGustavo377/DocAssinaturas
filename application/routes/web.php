<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// ROTAS USUARIOS
Route::get('/', function () {
    return view('welcome');
});

//ROTAS COMUNS PARA TODOS OS PERFIS




require __DIR__.'/auth.php';
require __DIR__.'/adminauth.php';
require __DIR__.'/proprietarioauth.php';
