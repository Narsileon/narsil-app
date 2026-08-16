<?php

declare(strict_types=1);

namespace App\Http\Resources;

#region USE

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\App;
use Locale;
use Narsil\Cms\Models\Globals\Footer;
use Narsil\Cms\Models\Globals\FooterLink;
use Narsil\Cms\Models\Globals\FooterSocialMedium;
use Narsil\Cms\Models\Sites\SitePage;
use Narsil\Cms\Models\Sites\SiteUrl;

#endregion

final class FooterResource extends JsonResource
{
    #region PUBLIC METHODS

    /**
     * @param Request $request
     *
     * @return array<string,mixed>
     */
    public function toArray(Request $request): array
    {
        $footer = $this->resource;

        return [
            Footer::CITY => $footer->{Footer::CITY},
            Footer::COPYRIGHT => $footer->{Footer::COPYRIGHT},
            Footer::COUNTRY => Locale::getDisplayRegion('_' . $footer->{Footer::COUNTRY}, App::getLocale()),
            Footer::EMAIL => $footer->{Footer::EMAIL},
            Footer::RELATION_LINKS => $footer->{Footer::RELATION_LINKS}->map(function (FooterLink $link): array
            {
                return [
                    FooterLink::LABEL => $link->{FooterLink::LABEL} ?: $link->{FooterLink::RELATION_SITE_PAGE}?->{SitePage::TITLE},
                    SiteUrl::URL => $link->{FooterLink::RELATION_SITE_PAGE}?->{SitePage::RELATION_URLS}->first()?->{SiteUrl::URL},
                ];
            })->all(),
            Footer::LOGO => $footer->{Footer::LOGO},
            Footer::ORGANIZATION => $footer->{Footer::ORGANIZATION},
            Footer::ORGANIZATION_SCHEMA => $footer->{Footer::ORGANIZATION_SCHEMA},
            Footer::PHONE => $footer->{Footer::PHONE},
            Footer::POSTAL_CODE => $footer->{Footer::POSTAL_CODE},
            Footer::RELATION_SOCIAL_MEDIA => $footer->{Footer::RELATION_SOCIAL_MEDIA}->map(function (FooterSocialMedium $socialMedium): array
            {
                return [
                    FooterSocialMedium::ICON => $socialMedium->{FooterSocialMedium::ICON},
                    FooterSocialMedium::LABEL => $socialMedium->{FooterSocialMedium::LABEL},
                    FooterSocialMedium::URL => $socialMedium->{FooterSocialMedium::URL},
                ];
            })->all(),
            Footer::STREET => $footer->{Footer::STREET},
        ];
    }

    #endregion
}
