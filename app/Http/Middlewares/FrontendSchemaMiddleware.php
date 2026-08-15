<?php

declare(strict_types=1);

namespace App\Http\Middlewares;

#region USE

use Closure;
use Illuminate\Http\Request;
use Narsil\Base\Traits\HasSchemas;

#endregion

final class FrontendSchemaMiddleware
{
    use HasSchemas;

    #region PUBLIC METHODS

    /**
     * @param Request $request
     * @param Closure $next
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next): mixed
    {
        $schema = $request->query('_schema');

        if (!is_string($schema) || !in_array($schema, $this->getSchemas(), true))
        {
            $schema = $this->getCurrentSchema();
        }

        $this->setSearchPath($schema);

        return $next($request);
    }

    #endregion
}
