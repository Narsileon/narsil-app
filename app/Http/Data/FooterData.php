<?php

namespace App\Http\Data;

#region USE

use Narsil\Models\Globals\Footer;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#endregion

#[TypeScript()]
final class FooterData extends Data
{
    #region CONSTRUCTOR

    /**
     * @param string|null $address_line_1
     * @param string|null $address_line_2
     * @param string|null $company
     * @param string|null $email
     * @param string|null $logo
     * @param string|null $phone
     * @param FooterLinkData[] $links
     * @param FooterSocialMediumData[] $social_media
     *
     * @return void
     */
    public function __construct(
        public ?string $address_line_1,
        public ?string $address_line_2,
        public ?string $company,
        public ?string $email,
        public ?string $logo,
        public ?string $phone,
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
            address_line_1: $footer->{Footer::ADDRESS_LINE_1},
            address_line_2: $footer->{Footer::ADDRESS_LINE_2},
            company: $footer->{Footer::COMPANY},
            email: $footer->{Footer::EMAIL},
            logo: $footer->{Footer::LOGO},
            phone: $footer->{Footer::PHONE},

            links: $footer->{Footer::RELATION_LINKS}
                ->map(fn($link) => FooterLinkData::from($link))
                ->all(),
            social_media: $footer->{Footer::RELATION_SOCIAL_MEDIA}
                ->map(fn($socialMedium) => FooterSocialMediumData::from($socialMedium))
                ->all(),
        );
    }

    #endregion
}
