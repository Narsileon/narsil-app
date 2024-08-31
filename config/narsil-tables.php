<?php

#region USE

use Narsil\Legals\Models\Imprint;
use Narsil\Legals\Models\PrivacyNotice;

#endregion

return [
    /**
     * DataTableCollections associated to the given models
     */
    'collections' => [],
    /**
     * ShowTableResources associated to the given models
     */
    'resources' => [],
    /**
     * Models associated to the given tables.
     */
    'table_to_model' => [
        Imprint::TABLE => Imprint::class,
        PrivacyNotice::TABLE => PrivacyNotice::class,
    ],
];
