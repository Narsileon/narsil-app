<?php

declare(strict_types=1);

namespace App\Models\Contents;

#region USE

use Narsil\Cms\Models\Entities\Entity;

#endregion

class Content extends Entity
{
    #region CONSTANTS

    /**
     * The table associated with the model.
     *
     * @var string
     */
    public final const TABLE = 'contents';

    #endregion
}
