<?php

#region USE

use Narsil\Auth\Http\Resources\User\UserDataTableCollection;
use Narsil\Auth\Http\Resources\User\UserShowTableResource;
use Narsil\Auth\Models\LoginLog;
use Narsil\Auth\Models\User;
use Narsil\Contacts\Models\Address;
use Narsil\Contacts\Models\PhoneNumber;
use Narsil\Legals\Http\Resources\Imprints\ImprintDataTableCollection;
use Narsil\Legals\Http\Resources\Imprints\ImprintShowTableResource;
use Narsil\Legals\Http\Resources\PrivacyNotices\PrivacyNoticeDataTableCollection;
use Narsil\Legals\Http\Resources\PrivacyNotices\PrivacyNoticeShowTableResource;
use Narsil\Legals\Models\Imprint;
use Narsil\Legals\Models\PrivacyNotice;
use Narsil\Localization\Http\Resources\Translations\TranslationDataTableCollection;
use Narsil\Localization\Http\Resources\Translations\TranslationShowTableResource;
use Narsil\Localization\Models\Language;
use Narsil\Localization\Models\Translation;
use Narsil\Menus\Http\Resources\MenuNodes\MenuNodeDataTableCollection;
use Narsil\Menus\Http\Resources\MenuNodes\MenuNodeShowTableResource;
use Narsil\Menus\Models\Menu;
use Narsil\Menus\Models\MenuNode;
use Narsil\Policies\Models\Permission;
use Narsil\Policies\Models\Role;
use Narsil\Storage\Models\Icon;
use Narsil\Storage\Models\Image;
use Narsil\Tables\Http\Resources\ModelComments\ModelCommentDataTableCollection;
use Narsil\Tables\Http\Resources\ModelComments\ModelCommentShowTableResource;
use Narsil\Tables\Models\ModelComment;

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

    'collections' => [
        Imprint::class => ImprintDataTableCollection::class,
        MenuNode::class => MenuNodeDataTableCollection::class,
        ModelComment::class => ModelCommentDataTableCollection::class,
        PrivacyNotice::class => PrivacyNoticeDataTableCollection::class,
        Translation::class => TranslationDataTableCollection::class,
        User::class => UserDataTableCollection::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | ShowTableResources
    |--------------------------------------------------------------------------
    |
    | List of ShowTableResources keyed by model.
    |
    */

    'resources' => [
        Imprint::class => ImprintShowTableResource::class,
        MenuNode::class => MenuNodeShowTableResource::class,
        ModelComment::class => ModelCommentShowTableResource::class,
        PrivacyNotice::class => PrivacyNoticeShowTableResource::class,
        Translation::class => TranslationShowTableResource::class,
        User::class => UserShowTableResource::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Models
    |--------------------------------------------------------------------------
    |
    | List of models keyed by table.
    |
    */

    'table_to_model' => [
        Address::TABLE => Address::class,
        Icon::TABLE => Icon::class,
        Image::TABLE => Image::class,
        Imprint::TABLE => Imprint::class,
        Language::TABLE => Language::class,
        LoginLog::TABLE => LoginLog::class,
        Menu::TABLE => Menu::class,
        MenuNode::TABLE => MenuNode::class,
        ModelComment::TABLE => ModelComment::class,
        Permission::TABLE => Permission::class,
        PhoneNumber::TABLE => PhoneNumber::class,
        PrivacyNotice::TABLE => PrivacyNotice::class,
        Role::TABLE => Role::class,
        Translation::TABLE => Translation::class,
        User::TABLE => User::class,
    ],
];
