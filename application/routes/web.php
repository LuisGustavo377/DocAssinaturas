<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;



//ROTAS GERAIS

Route::get('/', function () {
    return view('welcome');
});

Route::fallback(function () {
    return view('layouts.pagina-em-branco'); });


require __DIR__.'/auth.php';
require __DIR__.'/adminauth.php';
require __DIR__.'/proprietarioauth.php';
