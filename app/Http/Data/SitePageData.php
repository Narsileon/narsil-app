<?php

namespace App\Http\Data;

#region USE

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Narsil\Contracts\Fields\BuilderField;
use Narsil\Interfaces\IStructureHasElement;
use Narsil\Models\Entities\Entity;
use Narsil\Models\Entities\EntityNode;
use Narsil\Models\Sites\SitePage;
use Narsil\Models\Structures\Block;
use Narsil\Models\Structures\Field;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#endregion

#[TypeScript]
final class SitePageData extends Data
{
    #region CONSTRUCTOR

    /**
     * @param string $change_freq
     * @param array $data
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
        public array $data,
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

    #region PROPERTIES

    /**
     * The nodes of the entity grouped by parent uuid.
     *
     * @var Collection<string,EntityNode>
     */
    private static Collection $nodes;

    #endregion

    #region PUBLIC METHODS

    /**
     * @param SitePage $sitePage
     *
     * @return static
     */
    public static function fromModel(SitePage $sitePage): self
    {
        $data = static::resolveData($sitePage);

        return new static(
            id: $sitePage->{SitePage::ID},
            slug: $sitePage->{SitePage::SLUG},
            title: $sitePage->{SitePage::TITLE},
            data: $data,
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

    #region PRIVATE METHODS

    /**
     * @param SitePage $sitePage
     *
     * @return array
     */
    private static function resolveData(SitePage $sitePage): array
    {
        $entity = $sitePage->{SitePage::RELATION_ENTITIES}?->first();

        if (!$entity)
        {
            return [];
        }

        $nodes = $entity->{Entity::RELATION_NODES};

        $nodes->loadMissing([
            EntityNode::RELATION_BLOCK,
            EntityNode::RELATION_ELEMENT,
        ]);

        static::$nodes = $nodes->groupBy(EntityNode::PARENT_UUID);

        return static::processNodes();
    }

    /**
     * @param array $data
     * @param string|null $parentUuid
     * @param string|null $path
     *
     * @return array
     */
    private static function processNodes(array &$data = [], ?string $parentUuid = null, ?string $path = null): array
    {
        $nodes = static::$nodes->get($parentUuid, []);

        foreach ($nodes as $node)
        {
            $element = $node->{EntityNode::RELATION_ELEMENT};

            $handle = $element->{IStructureHasElement::HANDLE};

            if ($element->{IStructureHasElement::ELEMENT_TYPE} === Field::TABLE)
            {
                $field = $element->{IStructureHasElement::RELATION_ELEMENT};

                $key = $path ? "$path.$handle" : $handle;

                if ($field->{Field::TYPE} === BuilderField::class)
                {
                    $blockNodes = static::$nodes->get($node->{EntityNode::UUID}, []);

                    foreach ($blockNodes as $index => $blockNode)
                    {
                        Arr::set($data, "$key.$index", [
                            Block::HANDLE => $blockNode->{EntityNode::RELATION_BLOCK}->{Block::HANDLE},
                            EntityNode::BLOCK_ID => $blockNode->{EntityNode::BLOCK_ID},
                            EntityNode::UUID => $blockNode->{EntityNode::UUID},
                        ]);

                        $nextPath = "$key.$index." . EntityNode::RELATION_CHILDREN;

                        static::processNodes($data, $blockNode->{EntityNode::UUID}, $nextPath);
                    }
                }
                else
                {
                    Arr::set($data, $key, $node->{EntityNode::VALUE});
                }
            }
            else
            {
                $block = $element->{IStructureHasElement::RELATION_ELEMENT};

                if ($block->{Block::VIRTUAL})
                {
                    $nextPath = $path;
                }
                else
                {
                    $nextPath = $path ? "$path.$handle" : $handle;
                }

                static::processNodes($data, $node->{EntityNode::UUID}, $nextPath);
            }
        }

        return $data;
    }

    #endregion
}
