<?php

declare(strict_types=1);

namespace App\View\Components;

#region USE

use Illuminate\View\Component;

#endregion

final class Header extends Component
{
    #region CONSTRUCTOR

    /**
     * @param array<string,mixed> $navigation
     * @param array<string,mixed> $session
     *
     * @return void
     */
    public function __construct(
        array $navigation,
        array $session,
    )
    {
        $this->navigation = $navigation;
        $this->session = $session;
    }

    #endregion

    #region PROPERTIES

    /**
     * @var array<string,mixed>
     */
    public readonly array $navigation;

    /**
     * @var array<string,mixed>
     */
    public readonly array $session;

    #endregion

    #region PUBLIC METHODS

    /**
     * @return string
     */
    public function render(): string
    {
        return 'components.header';
    }

    #endregion
}
