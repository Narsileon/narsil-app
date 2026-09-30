<?php

declare(strict_types=1);

namespace App\View\Components\Footer;

#region USE

use Illuminate\View\Component;

#endregion

final class LegalLinks extends Component
{
    #region CONSTRUCTOR

    /**
     * @param array<int,array<string,mixed>> $links
     *
     * @return void
     */
    public function __construct(array $links)
    {
        $this->links = $links;
    }

    #endregion

    #region PROPERTIES

    /**
     * @var array<int,array<string,mixed>>
     */
    public readonly array $links;

    #endregion

    #region PUBLIC METHODS

    /**
     * {@inheritDoc}
     */
    public function render(): string
    {
        return 'components.footer.legal-links';
    }

    #endregion
}
