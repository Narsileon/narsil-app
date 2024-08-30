<?php

namespace App\Providers;

#region USE

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

#endregion

final class AppServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function register(): void
    {
        //
    }

    /**
     * @return void
     */
    public function boot(): void
    {
        Model::preventLazyLoading();
    }
}
