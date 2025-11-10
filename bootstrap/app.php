<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'role' => \App\Http\Middleware\RoleMiddleware::class,
<<<<<<< HEAD
            'verified.alumni' => \App\Http\Middleware\EnsureAlumniIsVerified::class,
=======
>>>>>>> 78ebf9cf692714fb93a2894277478235eb635f49
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
