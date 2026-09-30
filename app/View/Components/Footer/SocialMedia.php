<?php

declare(strict_types=1);

namespace App\View\Components\Footer;

#region USE

use Illuminate\View\Component;

#endregion

final class SocialMedia extends Component
{
    #region CONSTRUCTOR

    /**
     * @param array<int,array<string,mixed>> $socialMedia
     *
     * @return void
     */
    public function __construct(array $socialMedia)
    {
        $this->socialMedia = $socialMedia;
    }

    #endregion

    #region PROPERTIES

    /**
     * @var array<int,array<string,mixed>>
     */
    public readonly array $socialMedia;

    #endregion

    #region PUBLIC METHODS

    /**
     * {@inheritDoc}
     */
    public function render(): string
    {
        return 'components.footer.social-media';
    }

    #endregion
}
