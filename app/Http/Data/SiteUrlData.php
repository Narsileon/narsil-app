<?php

declare(strict_types=1);

namespace App\Http\Data;

#region USE

use Narsil\Cms\Models\Hosts\HostLocaleLanguage;
use Narsil\Cms\Models\Sites\SiteUrl;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#endregion

#[TypeScript]
final class SiteUrlData extends Data
{
    #region CONSTRUCTOR

    /**
     * @param string $display_language
     * @param string $language
     * @param string $url
     *
     * @return void
     */
    public function __construct(
        public string $display_language,
        public string $language,
        public string $url,
    )
    {
        //
    }

    #endregion

    #region PUBLIC METHODS

    /**
     * @param SiteUrl $siteUrl
     *
     * @return static
     */
    public static function fromModel(SiteUrl $siteUrl): self
    {
        $siteUrl->loadMissing([
            SiteUrl::RELATION_HOST_LOCALE_LANGUAGE,
        ]);

        $hostLocaleLanguage = $siteUrl->{SiteUrl::RELATION_HOST_LOCALE_LANGUAGE};

        return new static(
            display_language: $hostLocaleLanguage->{HostLocaleLanguage::ATTRIBUTE_DISPLAY_LANGUAGE},
            language: $hostLocaleLanguage->{HostLocaleLanguage::LANGUAGE},
            url: $siteUrl->{SiteUrl::URL},
        );
    }

    #endregion
}
