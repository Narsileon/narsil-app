<?php

#region USE

use App\Http\Middleware\HandleInertiaRequests;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
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
        $exceptions->respond(function ($response, Throwable $exception, Request $request)
        {
            $status = $response->getStatusCode();

            $errors = [
                403,
                404,
                419,
                429,
                500,
                503,
            ];

            if (app()->environment(['local']) && in_array($status, $errors))
            {
                return Inertia::render('Error/Index', compact('status'))
                    ->toResponse($request)
                    ->setStatusCode($status);
            }

            return $response;
        });
    })->create();
