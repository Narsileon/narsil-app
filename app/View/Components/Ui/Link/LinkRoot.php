<?php

declare(strict_types=1);

namespace App\View\Components\Ui\Link;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

#endregion

final class LinkRoot extends Component
{
    #region CONSTRUCTOR

    /**
     * @param string $href
     *
     * @return void
     */
    public function __construct(string $href)
    {
        $this->href = $href;
    }

    #endregion

    #region PROPERTIES

    /**
     * @var string
     */
    public readonly string $href;

    #endregion

    #region PUBLIC METHODS

    /**
     * {@inheritDoc}
     */
    public function render(): View
    {
        return view('components.ui.link.link-root');
    }

    #endregion
}
