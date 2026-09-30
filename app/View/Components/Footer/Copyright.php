<?php

declare(strict_types=1);

namespace App\View\Components\Footer;

#region USE

use Illuminate\View\Component;

#endregion

final class Copyright extends Component
{
    #region CONSTRUCTOR

    /**
     * @param string|null $copyright
     * @param string|null $organization
     *
     * @return void
     */
    public function __construct(
        ?string $copyright,
        ?string $organization,
    ) {
        $this->copyright = $copyright;
        $this->organization = $organization;
    }

    #endregion

    #region PROPERTIES

    /**
     * @var string|null
     */
    public readonly ?string $copyright;

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
        return 'components.footer.copyright';
    }

    #endregion
}
