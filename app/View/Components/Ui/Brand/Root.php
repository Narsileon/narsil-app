<?php

declare(strict_types=1);

namespace App\View\Components\Ui\Brand;

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
        return 'components.ui.brand.root';
    }

    #endregion
}
