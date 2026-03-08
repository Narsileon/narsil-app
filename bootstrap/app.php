<?php

#region USE

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Narsil\Cms\Jobs\PublishCollectionsJob;
use Symfony\Component\HttpFoundation\Response;

#endregion

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void
    {
        //
    })
    ->withSchedule(function (Schedule $schedule)
    {
        $schedule
            ->job(new PublishCollectionsJob())
            ->hourly()
            ->withoutOverlapping();
    })
    ->withExceptions(function (Exceptions $exceptions): void
    {
        $exceptions->respond(function (Response $response, Throwable $exception, Request $request)
        {
            $code = $response->getStatusCode();

            $isError = in_array($code, [
                403,
                404,
                500,
                503,
            ]);

            if ($isError && $request->is('admin/*'))
            {
                $title = trans("narsil::errors.titles.$code");
                $description = trans("narsil::errors.descriptions.$code");

                return Inertia::render('narsil/base::errors/index', [
                    'code' => $code,
                    'description' => $description,
                    'title' => $title,
                ])
                    ->toResponse($request)
                    ->setStatusCode($response->getStatusCode());
            }

            return $response;
        });
    })->create();
