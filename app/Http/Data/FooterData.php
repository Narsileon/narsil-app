<?php

declare(strict_types=1);

namespace App\Http\Data;

#region USE

use Illuminate\Support\Facades\App;
use Locale;
use Narsil\Cms\Models\Globals\Footer;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#endregion

#[TypeScript]
final class FooterData extends Data
{
    #region CONSTRUCTOR

    /**
     * @param string|null $city
     * @param string|null $copyright
     * @param string|null $country
     * @param string|null $email
     * @param string|null $logo
     * @param string|null $organization
     * @param bool $organizationSchema
     * @param string|null $phone
     * @param string|null $postal_code
     * @param string|null $street
     * @param FooterLinkData[] $links
     * @param FooterSocialMediumData[] $social_media
     *
     * @return void
     */
    public function __construct(
        public ?string $city,
        public ?string $copyright,
        public ?string $country,
        public ?string $email,
        public ?string $logo,
        public ?string $organization,
        public ?bool $organizationSchema,
        public ?string $phone,
        public ?string $postal_code,
        public ?string $street,
        public array $links,
        public array $social_media,
    )
    {
        //
    }

    #endregion

    #region PUBLIC METHODS

    /**
     * @param Footer $footer
     *
     * @return static
     */
    public static function fromModel(Footer $footer): self
    {
        return new static(
            city: $footer->{Footer::CITY},
            copyright: $footer->{Footer::COPYRIGHT},
            country: Locale::getDisplayRegion('_' . $footer->{Footer::COUNTRY}, App::getLocale()),
            email: $footer->{Footer::EMAIL},
            links: $footer->{Footer::RELATION_LINKS}
                ->map(function ($link)
                {
                    return FooterLinkData::from($link);
                })
                ->all(),
            logo: $footer->{Footer::LOGO},
            organization: $footer->{Footer::ORGANIZATION},
            organizationSchema: $footer->{Footer::ORGANIZATION_SCHEMA},
            phone: $footer->{Footer::PHONE},
            postal_code: $footer->{Footer::POSTAL_CODE},
            social_media: $footer->{Footer::RELATION_SOCIAL_MEDIA}
                ->map(function ($socialMedium)
                {
                    return FooterSocialMediumData::from($socialMedium);
                })
                ->all(),
            street: $footer->{Footer::STREET},
        );
    }

    #endregion
}
