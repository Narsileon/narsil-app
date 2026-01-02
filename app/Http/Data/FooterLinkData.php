<?php

namespace App\Http\Data;

#region USE

use Narsil\Models\Globals\FooterLink;
use Narsil\Models\Sites\SitePage;
use Narsil\Models\Sites\SiteUrl;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#endregion

#[TypeScript]
final class FooterLinkData extends Data
{
    #region CONSTRUCTOR

    /**
     * @param string $label
     * @param string $url
     *
     * @return void
     */
    public function __construct(
        public string $label,
        public string $url,
    )
    {
        //
    }

    #endregion

    #region PUBLIC METHODS

    /**
     * @param FooterLink $footerLink
     *
     * @return static
     */
    public static function fromModel(FooterLink $footerLink): self
    {
        return new static(
            label: static::getLabel($footerLink),
            url: $footerLink->{FooterLink::RELATION_SITE_PAGE}->{SitePage::RELATION_URLS}->first()->{SiteUrl::URL},
        );
    }

    #endregion

    #region PRIVATE METHODS

    /**
     * @return string
     */
    private static function getLabel(FooterLink $footerLink): string
    {
        $label = $footerLink->{FooterLink::LABEL};

        if (empty($label))
        {
            $label = $footerLink->{FooterLink::RELATION_SITE_PAGE}?->{SitePage::TITLE};
        }

        return $label;
    }

    #endregion
}
