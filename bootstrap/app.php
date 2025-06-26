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
    ->withMiddleware(function (Middleware $middleware): void {
        // Додаємо іменовані middleware
        $middleware->alias([
            'auth' => \App\Http\Middleware\Authenticate::class,
            'admin' => \App\Http\Middleware\IsAdmin::class, // твій кастомний middleware
            'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
            // ...
        ]);
        // (Групи та глобальні можеш додати аналогічно, якщо треба)
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
