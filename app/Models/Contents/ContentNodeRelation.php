<?php

declare(strict_types=1);

namespace App\Models\Contents;

#region USE

use Narsil\Cms\Models\Entities\EntityNodeRelation;

#endregion

class ContentNodeRelation extends EntityNodeRelation
{
    #region CONSTANTS

    /**
     * The table associated with the model.
     *
     * @var string
     */
    public final const TABLE = 'content_node_relation';

    #endregion
}
