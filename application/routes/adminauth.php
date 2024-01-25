<?php

use App\Http\Controllers\AdminAuth\AuthenticatedSessionController;
use App\Http\Controllers\AdminAuth\ConfirmablePasswordController;
use App\Http\Controllers\AdminAuth\EmailVerificationNotificationController;
use App\Http\Controllers\AdminAuth\EmailVerificationPromptController;
use App\Http\Controllers\AdminAuth\NewPasswordController;
use App\Http\Controllers\AdminAuth\PasswordController;
use App\Http\Controllers\AdminAuth\RegisteredUserController;
use App\Http\Controllers\AdminAuth\PasswordResetLinkController;
use App\Http\Controllers\AdminAuth\VerifyEmailController;
use App\Http\Controllers\AdminAuth\GrupoDeNegociosController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest:admin')->prefix('admin')->group(function () {

    Route::get('register', [RegisteredUserController::class, 'create'])
    ->name('admin.register');

    Route::post('register', [RegisteredUserController::class, 'store'])
    ->name('admin.register');

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->name('admin.login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
                ->name('admin.password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
                ->name('admin.password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('admin.password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
                ->name('admin.password.store');
});

Route::middleware('auth:admin')->prefix('admin')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
                ->name('admin.verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
                ->middleware(['signed', 'throttle:6,1'])
                ->name('admin.verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('admin.verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->name('admin.password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('admin.password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('admin.logout');
});


//ROTAS ESTABELECIMENTOS

Route::middleware('auth:admin')->prefix('admin')->group(function () {
    Route::get('dashboard', function () {
        return view('admin.dashboard');
    })->middleware([ 'verified'])->name('admin.dashboard');


Route::get('/grupo-de-negocios', [GrupoDeNegociosController::class, 'index'])->name('admin.grupo-de-negocios.index');
Route::get('/grupo-de-negocios/create', [GrupoDeNegociosController::class, 'create'])->name('admin.grupo-de-negocios.create');
Route::post('/grupo-de-negocios', [GrupoDeNegociosController::class, 'store'])->name('admin.grupo-de-negocios.store');
Route::get('/grupo-de-negocios/{id}', [GrupoDeNegociosController::class, 'show'])->name('admin.grupo-de-negocios.show');
Route::get('/grupo-de-negocios/{id}/edit', [GrupoDeNegociosController::class, 'edit'])->name('admin.grupo-de-negocios.edit');
Route::put('/grupo-de-negocios/{id}', [GrupoDeNegociosController::class, 'update'])->name('admin.grupo-de-negocios.update');
Route::post('/grupo-de-negocios/search', [GrupoDeNegociosController::class, 'search'])->name('admin.grupo-de-negocios.search');
Route::get('/grupo-de-negocios/inativar/{id}', [GrupoDeNegociosController::class, 'inativar'])->name('admin.grupo-de-negocios.inativar');
Route::get('/grupo-de-negocios/reativar/{id}', [GrupoDeNegociosController::class, 'reativar'])->name('admin.grupo-de-negocios.reativar');

});


//ROTAS PARA CIDADES
Route::get('/api/cidades/{estado_id}', [EstabelecimentoController::class, 'getCidadesPorEstado']);


