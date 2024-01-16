<?php

use App\Http\Controllers\ProprietarioAuth\AuthenticatedSessionController;
use App\Http\Controllers\ProprietarioAuth\ConfirmablePasswordController;
use App\Http\Controllers\ProprietarioAuth\EmailVerificationNotificationController;
use App\Http\Controllers\ProprietarioAuth\EmailVerificationPromptController;
use App\Http\Controllers\ProprietarioAuth\NewPasswordController;
use App\Http\Controllers\ProprietarioAuth\PasswordController;
use App\Http\Controllers\ProprietarioAuth\RegisteredUserController;
use App\Http\Controllers\ProprietarioAuth\PasswordResetLinkController;
use App\Http\Controllers\ProprietarioAuth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest:proprietario')->prefix('proprietario')->group(function () {

    Route::get('register', [RegisteredUserController::class, 'create'])
    ->name('proprietario.register');

    Route::post('register', [RegisteredUserController::class, 'store'])
    ->name('proprietario.register');

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->name('proprietario.login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
                ->name('proprietario.password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
                ->name('proprietario.password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('proprietario.password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
                ->name('proprietario.password.store');
});

Route::middleware('auth:proprietario')->prefix('proprietario')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
                ->name('proprietario.verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
                ->middleware(['signed', 'throttle:6,1'])
                ->name('proprietario.verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('proprietario.verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->name('proprietario.password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('proprietario.password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('proprietario.logout');
});


// ROTAS ACESSO PROPRIETARIOS
Route::get('/proprietario/dashboard', function () {
    return view('proprietario.dashboard');
})->middleware(['auth:proprietario', 'verified'])->name('proprietario.dashboard');

//ROTAS ESTABELECIMENTO

Route::middleware('auth')->group(function () {
    Route::resource('/estabelecimentos', EstabelecimentoController::class);
});