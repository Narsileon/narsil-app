<?php

declare(strict_types=1);

namespace App\Http\Data;

#region USE

use Narsil\Cms\Models\Globals\FooterSocialMedium;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#endregion

#[TypeScript]
final class FooterSocialMediumData extends Data
{
    #region CONSTRUCTOR

    /**
     * @param string $icon
     * @param string $label
     * @param string $url
     *
     * @return void
     */
    public function __construct(
        public string $icon,
        public string $label,
        public string $url,
    )
    {
        //
    }

    #endregion

    #region PUBLIC METHODS

    /**
     * @param FooterSocialMedium $footerSocialMedium
     *
     * @return static
     */
    public static function fromModel(FooterSocialMedium $footerSocialMedium): self
    {
        return new static(
            icon: $footerSocialMedium->{FooterSocialMedium::ICON},
            label: $footerSocialMedium->{FooterSocialMedium::LABEL},
            url: $footerSocialMedium->{FooterSocialMedium::URL},
        );
    }

    #endregion
}
