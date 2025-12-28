<?php

namespace App\Http\Data;

#region USE

use Narsil\Models\Sites\SitePage;
use Narsil\Models\Sites\SiteUrl;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#endregion

#[TypeScript()]
final class NavigationMenuItemData extends Data
{
    #region CONSTRUCTOR

    /**
     * @param int $id
     * @param string $title
     * @param string $url
     * @param NavigationMenuItemData[] $children
     *
     * @return void
     */
    public function __construct(
        public int $id,
        public string $title,
        public string $url,
        public array $children,
    )
    {
        //
    }

    #endregion

    #region PUBLIC METHODS

    /**
     * @param SitePage $sitePage
     *
     * @return static
     */
    public static function fromModel(SitePage $sitePage): self
    {
        return new static(
            id: $sitePage->{SitePage::ID},
            title: $sitePage->{SitePage::TITLE},
            url: $sitePage->{SitePage::RELATION_URLS}->first()->{SiteUrl::URL},

            children: $sitePage->{SitePage::RELATION_CHILDREN}
                ->map(fn(SitePage $child) => static::fromModel($child))
                ->all(),
        );
    }

    #endregion
}
