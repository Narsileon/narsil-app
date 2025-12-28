<?php

namespace App\Http\Data;

#region USE

use Illuminate\Support\Arr;
use Narsil\Contracts\Resources\EntityResource;
use Narsil\Models\Sites\SitePage;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#endregion

#[TypeScript]
final class SitePageData extends Data
{
    #region CONSTRUCTOR

    /**
     * @param string $change_freq
     * @param EntityResource|null $content
     * @param int $id
     * @param string|null $meta_description
     * @param string|null $open_graph_description
     * @param string|null $open_graph_image
     * @param string|null $open_graph_title
     * @param string|null $open_graph_type
     * @param float $priority
     * @param string $robots
     * @param string $slug
     * @param string $title
     * @param SiteUrlData[] $urls
     *
     * @return void
     */
    public function __construct(
        public int $id,
        public string $slug,
        public string $title,
        public mixed $content,
        public ?string $meta_description,
        public ?string $open_graph_description,
        public ?string $open_graph_image,
        public ?string $open_graph_title,
        public ?string $open_graph_type,
        public string $robots,
        public string $change_freq,
        public float $priority,
        public array $urls,
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
            slug: $sitePage->{SitePage::SLUG},
            title: $sitePage->{SitePage::TITLE},
            content: static::resolveEntity($sitePage),
            meta_description: $sitePage->{SitePage::META_DESCRIPTION},
            open_graph_description: $sitePage->{SitePage::OPEN_GRAPH_DESCRIPTION},
            open_graph_image: $sitePage->{SitePage::OPEN_GRAPH_IMAGE},
            open_graph_title: $sitePage->{SitePage::OPEN_GRAPH_TITLE},
            open_graph_type: $sitePage->{SitePage::OPEN_GRAPH_TYPE},
            robots: $sitePage->{SitePage::ROBOTS},
            change_freq: $sitePage->{SitePage::CHANGE_FREQ},
            priority: $sitePage->{SitePage::PRIORITY},
            urls: $sitePage->{SitePage::RELATION_URLS}
                ->map(fn($url) => SiteUrlData::from($url))
                ->all(),
        );
    }

    #endregion

    #region PROTECTED METHODS

    /**
     * Resolve site page entity.
     */
    protected static function resolveEntity(SitePage $sitePage): mixed
    {
        $entity = null;

        if ($identifier = Arr::first($sitePage->{SitePage::ENTITY}))
        {
            $entity = Arr::get(
                $sitePage->{SitePage::ATTRIBUTE_ENTITIES},
                $identifier
            );
        }

        return $entity;
    }

    #endregion
}
