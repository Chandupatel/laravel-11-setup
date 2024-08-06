<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
    
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        then: function () {
            Route::prefix('admin')
            ->middleware('web')
            ->name('admin.')
            ->group(base_path('routes/admin.php'));
        }
    )
    ->withMiddleware(function (Middleware $middleware) {
        /* $middleware->web(append: [
            EnsureUserIsSubscribed::class,
        ]);
     
        $middleware->api(prepend: [
            EnsureTokenIsValid::class,
        ]); */
        $middleware->alias([
            'admin' => \App\Http\Middleware\Admin::class
            
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();

    
