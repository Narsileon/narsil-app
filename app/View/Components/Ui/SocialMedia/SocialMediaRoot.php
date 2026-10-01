<?php

declare(strict_types=1);

namespace App\View\Components\Ui\SocialMedia;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

#endregion

final class SocialMediaRoot extends Component
{
    #region CONSTRUCTOR

    /**
     * @param string $label
     * @param string $url
     *
     * @return void
     */
    public function __construct(
        string $label,
        string $url,
    ) {
        $this->label = $label;
        $this->url = $url;
    }

    #endregion

    #region PROPERTIES

    /**
     * @var string
     */
    public readonly string $label;

    /**
     * @var string
     */
    public readonly string $url;

    #endregion

    #region PUBLIC METHODS

    /**
     * {@inheritDoc}
     */
    public function render(): View
    {
        return view('components.ui.social-media.social-media-root');
    }

    #endregion
}
