<?php

declare(strict_types=1);

namespace App\View\Components\Footer;

#region USE

use Illuminate\View\Component;

#endregion

final class LanguageSwitcher extends Component
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
    public function render(): string
    {
        return 'components.footer.language-switcher';
    }

    #endregion
}
