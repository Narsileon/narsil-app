<?php

#region USE

use Narsil\Cms\Enums\SchemaEnum;

#endregiom

return [

    /*
    |--------------------------------------------------------------------------
    | Database Schemas
    |--------------------------------------------------------------------------
    |
    | Available workspaces.
    |
    */

    SchemaEnum::LIVE->value,
    SchemaEnum::STAGE->value,
    SchemaEnum::DEV->value,
];
