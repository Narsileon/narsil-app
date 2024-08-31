<?php

#region USE

use Narsil\Legals\Http\Forms\ImprintForm;
use Narsil\Legals\Http\Forms\PrivacyNoticeForm;
use Narsil\Legals\Models\Imprint;
use Narsil\Legals\Models\PrivacyNotice;
use Narsil\Menus\Http\Forms\MenuForm;
use Narsil\Menus\Http\Forms\MenuNodeForm;
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
        Imprint::class => ImprintForm::class,
        Menu::class => MenuForm::class,
        MenuNode::class => MenuNodeForm::class,
        PrivacyNotice::class => PrivacyNoticeForm::class,
    ],
];
