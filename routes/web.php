<?php

#region USE

use App\Http\Controllers\PageController;
use App\Http\Middlewares\FrontendSchemaMiddleware;
use Illuminate\Support\Facades\Route;

#endregion

Route::middleware([
    FrontendSchemaMiddleware::class,
])->group(function ()
{
    Route::get('/', function ()
    {
        return redirect('/en');
    });

    Route::get('/{path?}', PageController::class)
        ->where('path', '^(?!narsil(?:/|$)).*');

    Route::domain('{subdomain}')
        ->get('/{path?}', PageController::class)
        ->where('path', '^(?!narsil(?:/|$)).*');
});
