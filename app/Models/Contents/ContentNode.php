<?php

declare(strict_types=1);

namespace App\Models\Contents;

#region USE

use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Narsil\Cms\Models\Entities\EntityNode;
use Narsil\Cms\Observers\EntityNodeObserver;

#endregion

#[ObservedBy([EntityNodeObserver::class])]
class ContentNode extends EntityNode
{
    #region CONSTANTS

    /**
     * The table associated with the model.
     *
     * @var string
     */
    public final const TABLE = 'content_nodes';

    #endregion
}
