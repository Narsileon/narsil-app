<?php

declare(strict_types=1);

namespace App\View\Components\Blocks\LanguageSwitcher;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

#endregion

final class LanguageSwitcherRoot extends Component
{
    #region CONSTRUCTOR

    /**
     * @param array<string,mixed> $page
     * @param array<string,string|null> $session
     *
     * @return void
     */
    public function __construct(
        array $page,
        array $session,
    ) {
        $this->page = $page;
        $this->session = $session;
    }

    #endregion

    #region PROPERTIES

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
        return view('components.blocks.language-switcher.language-switcher-root');
    }

    #endregion
}
