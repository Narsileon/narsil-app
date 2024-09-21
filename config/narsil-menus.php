<?php

#region USE

use Narsil\Menus\Enums\MenuEnum;
use Narsil\Menus\Enums\VisibilityEnum;
use Narsil\Menus\Models\MenuNode;

#endregion

return [
    /*
    |--------------------------------------------------------------------------
    | Backend Menu
    |--------------------------------------------------------------------------
    |
    | List of menus nodes.
    |
    */

    MenuEnum::BACKEND->value => [[
        MenuNode::LABEL => 'Users',
        MenuNode::URL => '/backend/users',
        MenuNode::VISIBILITY => VisibilityEnum::AUTH->value,
        MenuNode::RELATIONSHIP_ICON => 'lucide/user',
    ], [
        MenuNode::LABEL => 'Roles',
        MenuNode::URL => '/backend/roles',
        MenuNode::VISIBILITY => VisibilityEnum::AUTH->value,
        MenuNode::RELATIONSHIP_ICON => 'lucide/user-cog',
    ], [
        MenuNode::LABEL => 'Permissions',
        MenuNode::URL => '/backend/permissions',
        MenuNode::VISIBILITY => VisibilityEnum::AUTH->value,
        MenuNode::RELATIONSHIP_ICON => 'lucide/tag',
    ], [
        MenuNode::LABEL => 'Imprints',
        MenuNode::URL => '/backend/imprints',
        MenuNode::VISIBILITY => VisibilityEnum::AUTH->value,
        MenuNode::RELATIONSHIP_ICON => 'lucide/fingerprint',
    ], [
        MenuNode::LABEL => 'Privacy notices',
        MenuNode::URL => '/backend/privacy-notices',
        MenuNode::VISIBILITY => VisibilityEnum::AUTH->value,
        MenuNode::RELATIONSHIP_ICON => 'lucide/shield',
    ], [
        MenuNode::LABEL => 'Menus',
        MenuNode::URL => '/backend/menus',
        MenuNode::VISIBILITY => VisibilityEnum::AUTH->value,
        MenuNode::RELATIONSHIP_ICON => 'lucide/list-collapse',
    ], [
        MenuNode::LABEL => 'Menu nodes',
        MenuNode::URL => '/backend/menu-nodes',
        MenuNode::VISIBILITY => VisibilityEnum::AUTH->value,
        MenuNode::RELATIONSHIP_ICON => 'lucide/link',
    ], [
        MenuNode::LABEL => 'Languages',
        MenuNode::URL => '/backend/languages',
        MenuNode::VISIBILITY => VisibilityEnum::AUTH->value,
        MenuNode::RELATIONSHIP_ICON => 'lucide/languages',
    ], [
        MenuNode::LABEL => 'Translations',
        MenuNode::URL => '/backend/translations',
        MenuNode::VISIBILITY => VisibilityEnum::AUTH->value,
        MenuNode::RELATIONSHIP_ICON => 'lucide/book-a',
    ], [
        MenuNode::LABEL => 'Addresses',
        MenuNode::URL => '/backend/addresses',
        MenuNode::VISIBILITY => VisibilityEnum::AUTH->value,
        MenuNode::RELATIONSHIP_ICON => 'lucide/map-pin-house',
    ], [
        MenuNode::LABEL => 'Phone numbers',
        MenuNode::URL => '/backend/phone-numbers',
        MenuNode::VISIBILITY => VisibilityEnum::AUTH->value,
        MenuNode::RELATIONSHIP_ICON => 'lucide/phone',
    ], [
        MenuNode::LABEL => 'Login logs',
        MenuNode::URL => '/backend/login-logs',
        MenuNode::VISIBILITY => VisibilityEnum::AUTH->value,
        MenuNode::RELATIONSHIP_ICON => 'lucide/log-in',
    ], [
        MenuNode::LABEL => 'Model comments',
        MenuNode::URL => '/backend/model-comments',
        MenuNode::VISIBILITY => VisibilityEnum::AUTH->value,
        MenuNode::RELATIONSHIP_ICON => 'lucide/message-circle-warning',
    ]],

    /*
    |--------------------------------------------------------------------------
    | Footer Menu
    |--------------------------------------------------------------------------
    |
    | List of menus nodes.
    |
    */

    MenuEnum::FOOTER->value => [],

    /*
    |--------------------------------------------------------------------------
    | Header Menu
    |--------------------------------------------------------------------------
    |
    | List of menus nodes.
    |
    */

    MenuEnum::HEADER->value => [],
];
