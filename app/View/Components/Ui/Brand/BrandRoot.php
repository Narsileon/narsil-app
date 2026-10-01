<?php

declare(strict_types=1);

namespace App\View\Components\Ui\Brand;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

#endregion

final class BrandRoot extends Component
{
    #region PUBLIC METHODS

    /**
     * {@inheritDoc}
     */
    public function render(): View
    {
        return view('components.ui.brand.brand-root');
    }

    #endregion
}
