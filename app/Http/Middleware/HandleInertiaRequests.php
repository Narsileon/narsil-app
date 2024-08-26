<?php

namespace App\Http\Middleware;

#region USE

use App\Constants\AppSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Narsil\Auth\Constants\AuthSettings;
use Narsil\Auth\Models\User;
use Narsil\Menus\Enums\MenuEnum;
use Narsil\Menus\Models\Menu;
use Narsil\Menus\Services\BreadcrumbService;
use Narsil\Settings\Models\Setting;
use Narsil\Tree\Http\Resources\FlatNodeResource;
use Narsil\Tree\Http\Resources\NestedNodeResource;
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
     * @return array
     */
    protected function getShared(Request $request): array
    {
        $auth = $this->getAuth();
        $menus = $this->getMenus();

        return array_merge(parent::getShared($request), compact(
            'auth',
            'menus',
        ));
    }

    #endregion

    #region PRIVATE METHODS

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
     * @return array|null
     */
    protected function getMenus(): array
    {
        $breadcrumb = BreadcrumbService::getBreadcrumb();

        $backendMenu = Menu::type(MenuEnum::BACKEND->value)->first();
        $footerMenu = Menu::type(MenuEnum::FOOTER->value)->first();
        $headerMenu = Menu::type(MenuEnum::HEADER->value)->first();

        if ($backendMenu)
        {
            $backendMenu = FlatNodeResource::collection($backendMenu->{Menu::RELATIONSHIP_NODES});
        }
        if ($footerMenu)
        {
            $footerMenu = NestedNodeResource::collection($footerMenu->{Menu::RELATIONSHIP_VISIBLE_NODES});
        }
        if ($headerMenu)
        {
            $headerMenu = NestedNodeResource::collection($headerMenu->{Menu::RELATIONSHIP_VISIBLE_NODES});
        }

        return compact(
            'backendMenu',
            'breadcrumb',
            'footerMenu',
            'headerMenu',
        );
    }

    #endregion
}
