<?php

declare(strict_types=1);

namespace App\View\Components\Header;

#region USE

use Illuminate\View\Component;

#endregion

final class NavigationToggle extends Component
{
    #region PUBLIC METHODS

    /**
     * {@inheritDoc}
     */
    public function render(): string
    {
        return 'components.header.navigation-toggle';
    }

    #endregion
}
