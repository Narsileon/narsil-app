<?php

namespace App\Http\Middleware;

#region USE

use Narsil\UI\Http\Middleware\HandleInertiaRequests as BaseHandleInertiaRequests;

#endregion

final class HandleInertiaRequests extends BaseHandleInertiaRequests
{
    #region PROTECTED METHODS

    /**
     * @return array
     */
    protected function getApp(): array
    {
        return [
            'name' => 'Narsil App',
            'favicon' => null,
            'version' => '1.0.0',
        ];
    }

    #endregion
}
