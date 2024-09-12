<?php

#region USE

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
        PrivacyNotice::class => PrivacyNoticeFormResource::class,
        Translation::class => TranslationFormResource::class,
    ],
];
