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
use App\Http\Controllers\AdminAuth\LicencasController;
use App\Http\Controllers\AdminAuth\PessoaFisicaController;
use App\Http\Controllers\AdminAuth\PessoaJuridicaController;
use App\Http\Controllers\AdminAuth\UnidadeDeNegocioController;
use App\Http\Controllers\AdminAuth\CargoController;
use App\Http\Controllers\AdminAuth\TipoDeRelacionamentoController;
use App\Http\Controllers\CidadesController;

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

//GRUPOS DE NEGOCIOS
Route::get('/grupo-de-negocios', [GrupoDeNegociosController::class, 'index'])->name('admin.grupo-de-negocios.index');
Route::get('/grupo-de-negocios/create', [GrupoDeNegociosController::class, 'create'])->name('admin.grupo-de-negocios.create');
Route::post('/grupo-de-negocios', [GrupoDeNegociosController::class, 'store'])->name('admin.grupo-de-negocios.store');
Route::get('/grupo-de-negocios/{id}', [GrupoDeNegociosController::class, 'show'])->name('admin.grupo-de-negocios.show');
Route::get('/grupo-de-negocios/{id}/edit', [GrupoDeNegociosController::class, 'edit'])->name('admin.grupo-de-negocios.edit');
Route::put('/grupo-de-negocios/{id}', [GrupoDeNegociosController::class, 'update'])->name('admin.grupo-de-negocios.update');
Route::post('/grupo-de-negocios/search', [GrupoDeNegociosController::class, 'search'])->name('admin.grupo-de-negocios.search');
Route::get('/grupo-de-negocios/inativar/{id}', [GrupoDeNegociosController::class, 'inativar'])->name('admin.grupo-de-negocios.inativar');
Route::get('/grupo-de-negocios/reativar/{id}', [GrupoDeNegociosController::class, 'reativar'])->name('admin.grupo-de-negocios.reativar');

//UNIDADE DE NEGOCIOS
Route::get('/unidade-de-negocio', [UnidadeDeNegocioController::class, 'index'])->name('admin.unidade-de-negocio.index');
Route::get('/unidade-de-negocio/create', [UnidadeDeNegocioController::class, 'create'])->name('admin.unidade-de-negocio.create');
Route::post('/unidade-de-negocio', [UnidadeDeNegocioController::class, 'store'])->name('admin.unidade-de-negocio.store');
Route::get('/unidade-de-negocio/{id}', [UnidadeDeNegocioController::class, 'show'])->name('admin.unidade-de-negocio.show');
Route::get('/unidade-de-negocio/{id}/edit', [UnidadeDeNegocioController::class, 'edit'])->name('admin.unidade-de-negocio.edit');
Route::put('/unidade-de-negocio/{id}', [UnidadeDeNegocioController::class, 'update'])->name('admin.unidade-de-negocio.update');
Route::post('/unidade-de-negocio/search', [UnidadeDeNegocioController::class, 'search'])->name('admin.unidade-de-negocio.search');
Route::get('/unidade-de-negocio/inativar/{id}', [UnidadeDeNegocioController::class, 'inativar'])->name('admin.unidade-de-negocio.inativar');
Route::get('/unidade-de-negocio/reativar/{id}', [UnidadeDeNegocioController::class, 'reativar'])->name('admin.unidade-de-negocio.reativar');


//PESSOA FISICA
Route::get('/pessoa-fisica', [PessoaFisicaController::class, 'index'])->name('admin.pessoa-fisica.index');
Route::get('/pessoa-fisica/create', [PessoaFisicaController::class, 'create'])->name('admin.pessoa-fisica.create');
Route::post('/pessoa-fisica', [PessoaFisicaController::class, 'store'])->name('admin.pessoa-fisica.store');
Route::get('/pessoa-fisica/{id}', [PessoaFisicaController::class, 'show'])->name('admin.pessoa-fisica.show');
Route::get('/pessoa-fisica/{id}/edit', [PessoaFisicaController::class, 'edit'])->name('admin.pessoa-fisica.edit');
Route::put('/pessoa-fisica/{id}', [PessoaFisicaController::class, 'update'])->name('admin.pessoa-fisica.update');
Route::post('/pessoa-fisica/search', [PessoaFisicaController::class, 'search'])->name('admin.pessoa-fisica.search');
Route::get('/pessoa-fisica/inativar/{id}', [PessoaFisicaController::class, 'inativar'])->name('admin.pessoa-fisica.inativar');
Route::get('/pessoa-fisica/reativar/{id}', [PessoaFisicaController::class, 'reativar'])->name('admin.pessoa-fisica.reativar');

//PESSOA JURIDICA
Route::get('/pessoa-juridica', [PessoaJuridicaController::class, 'index'])->name('admin.pessoa-juridica.index');
Route::get('/pessoa-juridica/create', [PessoaJuridicaController::class, 'create'])->name('admin.pessoa-juridica.create');
Route::post('/pessoa-juridica', [PessoaJuridicaController::class, 'store'])->name('admin.pessoa-juridica.store');
Route::get('/pessoa-juridica/{id}', [PessoaJuridicaController::class, 'show'])->name('admin.pessoa-juridica.show');
Route::get('/pessoa-juridica/{id}/edit', [PessoaJuridicaController::class, 'edit'])->name('admin.pessoa-juridica.edit');
Route::put('/pessoa-juridica/{id}', [PessoaJuridicaController::class, 'update'])->name('admin.pessoa-juridica.update');
Route::post('/pessoa-juridica/search', [PessoaJuridicaController::class, 'search'])->name('admin.pessoa-juridica.search');
Route::get('/pessoa-juridica/inativar/{id}', [PessoaJuridicaController::class, 'inativar'])->name('admin.pessoa-juridica.inativar');
Route::get('/pessoa-juridica/reativar/{id}', [PessoaJuridicaController::class, 'reativar'])->name('admin.pessoa-juridica.reativar');

//LICENÇAS
Route::get('/licencas', [LicencasController::class, 'index'])->name('admin.licencas.index');
Route::get('/licenca/create', [LicencasController::class, 'create'])->name('admin.licencas.create');
Route::post('/licenca', [LicencasController::class, 'store'])->name('admin.licencas.store');
Route::get('/licenca/{id}', [LicencasController::class, 'show'])->name('admin.licencas.show');
Route::get('/licenca/{id}/edit', [LicencasController::class, 'edit'])->name('admin.licencas.edit');
Route::put('/licenca/{id}', [LicencasController::class, 'update'])->name('admin.licencas.update');
Route::post('/licenca/search', [LicencasController::class, 'search'])->name('admin.licencas.search');
Route::get('/licenca/inativar/{id}', [LicencasController::class, 'inativar'])->name('admin.licencas.inativar');
Route::get('/licenca/reativar/{id}', [LicencasController::class, 'reativar'])->name('admin.licencas.reativar');

});



//ROTAS PARA CIDADES
Route::get('/api/cidades/{estado_id}', [CidadesController::class, 'getCidadesPorEstado']);


