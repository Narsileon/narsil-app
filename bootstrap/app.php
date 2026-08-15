<?php

#region USE

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Narsil\Cms\Http\Middleware\InertiaMiddleware;
use Narsil\Cms\Http\Resources\InertiaResource;
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
        $middleware->web(append: [
            InertiaMiddleware::class,
        ]);
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

            if ($isError && $request->is('narsil/*'))
            {
                $title = trans("narsil::errors.titles.$code");
                $description = trans("narsil::errors.descriptions.$code");

                $props = (new InertiaResource([
                    'code' => $code,
                    'description' => $description,
                    'title' => $title,
                ]))->toArray($request);

                return Inertia::render('narsil/base::errors/index', $props)
                    ->rootView('backend')
                    ->toResponse($request)
                    ->setStatusCode($response->getStatusCode());
            }

            return $response;
        });
    })->create();
