<?php

#region USE

use Narsil\Auth\Models\LoginLog;
use Narsil\Legals\Models\Imprint;
use Narsil\Legals\Models\PrivacyNotice;
use Narsil\Localization\Models\Language;
use Narsil\Localization\Models\Translation;
use Narsil\Menus\Models\Menu;
use Narsil\Menus\Models\MenuNode;
use Narsil\Policies\Models\Role;
use Narsil\Storage\Models\Icon;
use Narsil\Storage\Models\Image;

#endregion

return [
    /*
    |--------------------------------------------------------------------------
    | Provider
    |--------------------------------------------------------------------------
    |
    | Provider settings.
    |
    */

    'provider' => [
        'routes' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | DataTableCollections
    |--------------------------------------------------------------------------
    |
    | List of DataTableCollections keyed by model.
    |
    */

    'collections' => [],

    /*
    |--------------------------------------------------------------------------
    | ShowTableResources
    |--------------------------------------------------------------------------
    |
    | List of ShowTableResources keyed by model.
    |
    */

    'resources' => [],

    /*
    |--------------------------------------------------------------------------
    | Models
    |--------------------------------------------------------------------------
    |
    | List of models keyed by table.
    |
    */

    'table_to_model' => [
        Icon::TABLE => Icon::class,
        Image::TABLE => Image::class,
        Imprint::TABLE => Imprint::class,
        Language::TABLE => Language::class,
        LoginLog::TABLE => LoginLog::class,
        Menu::TABLE => Menu::class,
        MenuNode::TABLE => MenuNode::class,
        PrivacyNotice::TABLE => PrivacyNotice::class,
        Role::TABLE => Role::class,
        Translation::TABLE => Translation::class,
    ],
];
