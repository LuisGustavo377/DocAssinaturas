<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $exception)
    {
        if ($exception instanceof \PDOException) {
            // Verifica se a exceção é relacionada a SQLSTATE[22P02]
            if (strpos($exception->getMessage(), 'SQLSTATE[22P02]') !== false) {
                // Redireciona para a página em branco ou qualquer outra ação desejada
                return response()->view('layouts.pagina-em-branco', [], 500);
            }
        }

        return parent::render($request, $exception);
    }
}
