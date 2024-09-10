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
use Narsil\Pages\Models\PageContent;
use Narsil\Policies\Interfaces\IHasPermissions;
use Narsil\Policies\Models\Permission;
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
        $favicon = Setting::get(AppSettings::FAVICON);
        $logo = Setting::get(AppSettings::LOGO);
        $name = Setting::get(AppSettings::NAME, 'Narsil');
        $version = Setting::get(AppSettings::VERSION, '1.0.0');
        $registerable = Setting::get(AuthSettings::REGISTERABLE, true);

        $page = [
            PageContent::DESCRIPTION => null,
            PageContent::TITLE => null,
        ];

        return compact(
            'favicon',
            'logo',
            'name',
            'page',
            'version',
            'registerable',
        );
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
            User::FIRST_NAME => $user->{User::FIRST_NAME},
            User::FULL_NAME => $user->{User::FULL_NAME},
            User::ID => $user->{User::ID},
            User::LAST_NAME => $user->{User::LAST_NAME},
            User::USERNAME => $user->{User::USERNAME},

            IHasPermissions::RELATIONSHIP_PERMISSIONS => $user->getPermissions()->pluck(Permission::NAME)->toArray(),
        ];
    }

    /**
     * @return array|null
     */
    protected function getMenus(): array
    {
        $breadcrumb = BreadcrumbService::getBreadcrumb();

        $backend = Menu::type(MenuEnum::BACKEND->value)->first();
        $footer = Menu::type(MenuEnum::FOOTER->value)->first();
        $header = Menu::type(MenuEnum::HEADER->value)->first();

        if ($backend)
        {
            $backend = FlatNodeResource::collection($backend->{Menu::RELATIONSHIP_NODES});
        }
        if ($footer)
        {
            $footer = NestedNodeResource::collection($footer->{Menu::RELATIONSHIP_VISIBLE_NODES});
        }
        if ($header)
        {
            $header = NestedNodeResource::collection($header->{Menu::RELATIONSHIP_VISIBLE_NODES});
        }

        return compact(
            'backend',
            'breadcrumb',
            'footer',
            'header',
        );
    }

    #endregion
}
