<?php

#region USE

use Narsil\Auth\Http\Menus\AuthMenu;
use Narsil\Contacts\Http\Menus\ContactsMenu;
use Narsil\Legals\Http\Menus\LegalsMenu;
use Narsil\Localization\Http\Menus\LocalizationMenu;
use Narsil\Menus\Http\Menus\MenusMenu;
use Narsil\Policies\Http\Menus\PoliciesMenu;
use Narsil\Tables\Http\Menus\TablesMenu;

#endregion

return [
    /*
    |--------------------------------------------------------------------------
    | Menus
    |--------------------------------------------------------------------------
    |
    | List of menus classes.
    |
    */

    'menus' => [
        AuthMenu::class,
        ContactsMenu::class,
        LegalsMenu::class,
        LocalizationMenu::class,
        MenusMenu::class,
        PoliciesMenu::class,
        TablesMenu::class,
    ],
];
