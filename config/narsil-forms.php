<?php

#region USE

use Narsil\Auth\Http\Resources\User\UserFormResource;
use Narsil\Auth\Models\User;
use Narsil\Legals\Http\Resources\Imprints\ImprintFormResource;
use Narsil\Legals\Http\Resources\PrivacyNotices\PrivacyNoticeFormResource;
use Narsil\Legals\Models\Imprint;
use Narsil\Legals\Models\PrivacyNotice;
use Narsil\Localization\Http\Resources\Languages\LanguageFormResource;
use Narsil\Localization\Http\Resources\Translations\TranslationFormResource;
use Narsil\Localization\Models\Language;
use Narsil\Localization\Models\Translation;
use Narsil\Menus\Http\Resources\MenuNodes\MenuNodeFormResource;
use Narsil\Menus\Http\Resources\Menus\MenuFormResource;
use Narsil\Menus\Models\Menu;
use Narsil\Menus\Models\MenuNode;
use Narsil\Policies\Http\Resources\Permissions\PermissionFormResource;
use Narsil\Policies\Http\Resources\Roles\RoleFormResource;
use Narsil\Policies\Models\Permission;
use Narsil\Policies\Models\Role;

#endregion

return [
    /*
    |--------------------------------------------------------------------------
    | Forms
    |--------------------------------------------------------------------------
    |
    | List of forms keyed by model.
    |
    */

    'forms' => [
        Imprint::class => ImprintFormResource::class,
        Language::class => LanguageFormResource::class,
        Menu::class => MenuFormResource::class,
        MenuNode::class => MenuNodeFormResource::class,
        Permission::class => PermissionFormResource::class,
        PrivacyNotice::class => PrivacyNoticeFormResource::class,
        Role::class => RoleFormResource::class,
        Translation::class => TranslationFormResource::class,
        User::class => UserFormResource::class,
    ],
];
