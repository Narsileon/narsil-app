<?php

namespace App\Http\Middlewares;

#region USE

use Illuminate\Http\Request;
use Inertia\Middleware;
use Narsil\Base\Traits\HasSchemas;

#endregions

class InertiaMiddleware extends Middleware
{
    use HasSchemas;

    #region PROPERTIES

    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     *
     * @var string
     */
    protected $rootView = 'frontend';

    #endreion

    #region PUBLIC METHODS

    /**
     * Determine the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     *
     * @return string|null
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        // $this->setSearchPath('cms');

        return [
            ...parent::share($request),
        ];
    }

    #endregion
}
