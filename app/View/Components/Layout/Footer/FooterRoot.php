<?php

declare(strict_types=1);

namespace App\View\Components\Layout\Footer;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

#endregion

final class FooterRoot extends Component
{
    #region CONSTRUCTOR

    /**
     * @param array<string,mixed> $footer
     * @param array<string,mixed> $page
     * @param array<string,string|null> $session
     *
     * @return void
     */
    public function __construct(
        array $footer,
        array $page,
        array $session,
    ) {
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
     * @var array<string,string|null>
     */
    public readonly array $session;

    #endregion

    #region PUBLIC METHODS

    /**
     * {@inheritDoc}
     */
    public function render(): View
    {
        return view('components.layout.footer.footer-root');
    }

    #endregion
}
