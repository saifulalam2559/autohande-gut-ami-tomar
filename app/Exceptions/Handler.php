<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Session\TokenMismatchException;
use Throwable;

class Handler extends ExceptionHandler
{
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $exception)
    {
        // Handle 419 errors (TokenMismatchException)
        if ($exception instanceof TokenMismatchException) {
            // Redirect to home or any other page
            return redirect()->route('fronthome')->with('message', 'Ihre Sitzung ist abgelaufen. Bitte versuchen Sie es erneut.');
        }

        return parent::render($request, $exception);
    }
    
    
}
