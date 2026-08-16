<?php

declare(strict_types=1);

namespace App\View\Components;

#region USE

use Illuminate\View\Component;

#endregion

final class Footer extends Component
{
    #region CONSTRUCTOR

    /**
     * @param array<string,mixed> $footer
     * @param array<string,mixed> $page
     * @param array<string,mixed> $session
     *
     * @return void
     */
    public function __construct(
        array $footer,
        array $page,
        array $session,
    )
    {
        $this->footer = $footer;
        $this->page = $page;
        $this->session = $session;
    }

    #endregion

    #region PROPERTIES

    /**
     * @var array<string,mixed>
     */
    public readonly array $footer;

    /**
     * @var array<string,mixed>
     */
    public readonly array $page;

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
        return 'components.footer';
    }

    #endregion
}
