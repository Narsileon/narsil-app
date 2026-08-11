<?php

namespace App\Http\Middlewares;

#region USE

use Illuminate\Http\Request;
use Inertia\Middleware;
use Narsil\Base\Traits\HasSchemas;

#endregion

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
     * @return array<string,mixed>
     */
    public function share(Request $request): array
    {
        $this->setSearchPath($this->getRequestedSchema($request));

        return [
            ...parent::share($request),
        ];
    }

    #endregion

    #region PROTECTED METHODS

    /**
     * Get the schema to read from.
     *
     * The live editor previews a page inside an iframe and passes the schema it
     * is editing, so the preview shows that workspace instead of the default.
     *
     * @param Request $request
     *
     * @return string
     */
    protected function getRequestedSchema(Request $request): string
    {
        $schema = $request->query('_schema');

        if (is_string($schema) && in_array($schema, $this->getSchemas()))
        {
            return $schema;
        }

        return $this->getDefaultSchema();
    }

    #endregion
}
