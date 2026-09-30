<?php

declare(strict_types=1);

namespace App\View\Components\Header;

#region USE

use Illuminate\View\Component;

#endregion

final class Root extends Component
{
    #region PUBLIC METHODS

    /**
     * {@inheritDoc}
     */
    public function render(): string
    {
        return 'components.header.root';
    }

    #endregion
}
