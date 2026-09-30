<?php

declare(strict_types=1);

namespace App\View\Components\Header;

#region USE

use Illuminate\View\Component;

#endregion

final class Navigation extends Component
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
    public function render(): string
    {
        return 'components.header.navigation';
    }

    #endregion
}
