<?php

#region USE

use App\Http\Middleware\HandleInertiaRequests;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;
use Narsil\Localization\Commands\SyncTranslationsCommand;
use Narsil\Localization\Http\Middleware\LocalizationMiddleware;

#endregion

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
        then: function ()
        {
            Route::middleware([
                'web',
                'auth',
                'verified',
            ])->prefix('backend')
                ->name('backend.')
                ->group(base_path('routes/backend.php'));
        },
    )
    ->withMiddleware(function (Middleware $middleware)
    {
        $middleware->web(append: [
            LocalizationMiddleware::class,
            HandleInertiaRequests::class,
        ]);
    })
    ->withCommands([
        SyncTranslationsCommand::class,
    ])
    ->withExceptions(function (Exceptions $exceptions)
    {
        //
    })->create();
