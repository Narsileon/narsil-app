<?php

declare(strict_types=1);

namespace App\View\Components\Footer;

#region USE

use Illuminate\View\Component;

#endregion

final class Organization extends Component
{
    #region CONSTRUCTOR

    /**
     * @param string|null $organization
     *
     * @return void
     */
    public function __construct(?string $organization)
    {
        $this->organization = $organization;
    }

    #endregion

    #region PROPERTIES

    /**
     * @var string|null
     */
    public readonly ?string $organization;

    #endregion

    #region PUBLIC METHODS

    /**
     * {@inheritDoc}
     */
    public function render(): string
    {
        return 'components.footer.organization';
    }

    #endregion
}
