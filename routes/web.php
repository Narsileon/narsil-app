<?php

#region USE

use App\Http\Controllers\PageController;
use App\Http\Middlewares\InertiaMiddleware;
use Illuminate\Support\Facades\Route;

#endregion

Route::middleware([
    InertiaMiddleware::class,
])->group(function ()
{
    Route::get('/', function ()
    {
        return redirect('/en');
    });

    Route::get('/{path?}', PageController::class)
        ->where('path', '.*');

    Route::domain('{subdomain}')
        ->get('/{path?}', PageController::class)
        ->where('path', '.*');
});
