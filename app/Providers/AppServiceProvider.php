<?php

namespace App\Providers;

#region USE

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

#endregion

final class AppServiceProvider extends ServiceProvider
{
    #region PUBLIC METHODS

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        if ($this->app->environment('local'))
        {
            Gate::before(fn () => true);
        }
    }

    /**
     * {@inheritDoc}
     */
    public function register(): void
    {
        //
    }

    #endregion
}
