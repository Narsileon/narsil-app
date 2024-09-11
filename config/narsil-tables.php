<?php

#region USE

use Narsil\Auth\Models\LoginLog;
use Narsil\Contacts\Models\Address;
use Narsil\Contacts\Models\PhoneNumber;
use Narsil\Legals\Http\Resources\ImprintDataTableCollection;
use Narsil\Legals\Http\Resources\ImprintShowTableResource;
use Narsil\Legals\Http\Resources\PrivacyNoticeDataTableCollection;
use Narsil\Legals\Http\Resources\PrivacyNoticeShowTableResource;
use Narsil\Legals\Models\Imprint;
use Narsil\Legals\Models\PrivacyNotice;
use Narsil\Localization\Http\Resources\TranslationDataTableCollection;
use Narsil\Localization\Http\Resources\TranslationShowTableResource;
use Narsil\Localization\Models\Language;
use Narsil\Localization\Models\Translation;
use Narsil\Menus\Http\Resources\MenuNodeDataTableCollection;
use Narsil\Menus\Http\Resources\MenuNodeShowTableResource;
use Narsil\Menus\Models\Menu;
use Narsil\Menus\Models\MenuNode;
use Narsil\Policies\Models\Role;
use Narsil\Storage\Models\Icon;
use Narsil\Storage\Models\Image;
use Narsil\Tables\Http\Resources\ModelCommentDataTableCollection;
use Narsil\Tables\Http\Resources\ModelCommentShowTableResource;
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
        PhoneNumber::TABLE => PhoneNumber::class,
        PrivacyNotice::TABLE => PrivacyNotice::class,
        Role::TABLE => Role::class,
        Translation::TABLE => Translation::class,
    ],
];
