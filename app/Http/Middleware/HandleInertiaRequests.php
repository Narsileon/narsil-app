<?php

namespace App\Http\Middleware;

#region USE

use App\Constants\AppSettings;
use Narsil\Settings\Models\Setting;
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
            'name' => Setting::get(AppSettings::NAME, 'Narsil'),
            'favicon' => Setting::get(AppSettings::FAVICON),
            'logo' => Setting::get(AppSettings::LOGO),
            'version' => '1.0.0',
        ];
    }

    #endregion
}
