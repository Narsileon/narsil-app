<?php

declare(strict_types=1);

namespace App\View\Components\Layout\Navigation;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

#endregion

final class NavigationRoot extends Component
{
    #region CONSTRUCTOR

    /**
     * @param array<int,array<string,mixed>> $items
     *
     * @return void
     */
    public function __construct(array $items)
    {
        $this->items = $items;
    }

    #endregion

    #region PROPERTIES

    /**
     * @var array<int,array<string,mixed>>
     */
    public readonly array $items;

    #endregion

    #region PUBLIC METHODS

    /**
     * {@inheritDoc}
     */
    public function render(): View
    {
        return view('components.layout.navigation.navigation-root');
    }

    #endregion
}
