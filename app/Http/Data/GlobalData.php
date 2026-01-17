<?php

namespace App\Http\Data;

#region USE

use Narsil\Support\TranslationsBag;
use Spatie\LaravelData\Attributes\Computed;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#endregion

#[TypeScript]
final class GlobalData extends Data
{
    #region CONSTRUCTOR

    /**
     * @param SitePageData $page
     * @param HeaderData $header
     * @param FooterData $footer
     * @param NavigationMenuItemData[] $navigation
     * @param SessionData $session
     *
     * @return void
     */
    public function __construct(
        public SitePageData $page,
        public HeaderData $header,
        public FooterData $footer,
        public DataCollection $navigation,
        public SessionData $session = new SessionData(),
    )
    {
        $this->translations = app(TranslationsBag::class)->get();
    }

    #endregion

    #region PROPERTIES

    #[Computed]
    /**
     * @var array<string,string>
     */
    public array $translations;

    #endregion
}
