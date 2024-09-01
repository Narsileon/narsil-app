<?php

#region USE

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Narsil\Auth\Http\Middleware\PublicMiddleware;

#endregion

Route::middleware([
    PublicMiddleware::class,
])->group(function ()
{
    Route::get('/', HomeController::class)
        ->name('home');
});
