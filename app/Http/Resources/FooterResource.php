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
            'city' => $footer->{Footer::CITY},
            'copyright' => $footer->{Footer::COPYRIGHT},
            'country' => Locale::getDisplayRegion('_' . $footer->{Footer::COUNTRY}, App::getLocale()),
            'email' => $footer->{Footer::EMAIL},
            'links' => $footer->{Footer::RELATION_LINKS}->map(function (FooterLink $link): array
            {
                return [
                    'label' => $link->{FooterLink::LABEL} ?: $link->{FooterLink::RELATION_SITE_PAGE}?->{SitePage::TITLE},
                    'url' => $link->{FooterLink::RELATION_SITE_PAGE}?->{SitePage::RELATION_URLS}->first()?->{SiteUrl::URL},
                ];
            })->all(),
            'logo' => $footer->{Footer::LOGO},
            'organization' => $footer->{Footer::ORGANIZATION},
            'organizationSchema' => $footer->{Footer::ORGANIZATION_SCHEMA},
            'phone' => $footer->{Footer::PHONE},
            'postal_code' => $footer->{Footer::POSTAL_CODE},
            'social_media' => $footer->{Footer::RELATION_SOCIAL_MEDIA}->map(function (FooterSocialMedium $socialMedium): array
            {
                return [
                    'icon' => $socialMedium->{FooterSocialMedium::ICON},
                    'label' => $socialMedium->{FooterSocialMedium::LABEL},
                    'url' => $socialMedium->{FooterSocialMedium::URL},
                ];
            })->all(),
            'street' => $footer->{Footer::STREET},
        ];
    }

    #endregion
}
