<?php

#region USE

use Narsil\Auth\Http\Menus\AuthMenu;
use Narsil\Legals\Http\Menus\LegalsMenu;
use Narsil\Localization\Http\Menus\LocalizationMenu;
use Narsil\Menus\Http\Menus\MenusMenu;
use Narsil\Policies\Http\Menus\PoliciesMenu;

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
        LegalsMenu::class,
        LocalizationMenu::class,
        MenusMenu::class,
        PoliciesMenu::class,
    ],
];
