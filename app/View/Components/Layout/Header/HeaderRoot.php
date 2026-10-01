<?php

declare(strict_types=1);

namespace App\View\Components\Layout\Header;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

#endregion

final class HeaderRoot extends Component
{
    #region PUBLIC METHODS

    /**
     * {@inheritDoc}
     */
    public function render(): View
    {
        return view('components.layout.header.header-root');
    }

    #endregion
}
