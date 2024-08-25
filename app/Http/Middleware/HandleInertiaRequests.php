<?php

namespace App\Http\Middleware;

#region USE

use App\Constants\AppSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Narsil\Auth\Constants\AuthSettings;
use Narsil\Auth\Models\User;
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
            AppSettings::FAVICON => Setting::get(AppSettings::FAVICON),
            AppSettings::LOGO => Setting::get(AppSettings::LOGO),
            AppSettings::NAME => Setting::get(AppSettings::NAME, 'Narsil'),
            AppSettings::VERSION => Setting::get(AppSettings::VERSION, '1.0.0'),
            AuthSettings::REGISTERABLE => Setting::get(AuthSettings::REGISTERABLE, true),
        ];
    }

    /**
     * @return array|null
     */
    protected function getAuth(): array | null
    {
        $user = Auth::user();

        if (!$user)
        {
            return null;
        }

        return [
            User::FULL_NAME => $user->{User::FULL_NAME},
            User::ID => $user->{User::ID},
            User::USERNAME => $user->{User::USERNAME},
        ];
    }

    /**
     * @return array
     */
    protected function getShared(Request $request): array
    {
        $auth = $this->getAuth();

        return array_merge(parent::getShared($request), compact(
            'auth',
        ));
    }

    #endregion
}
