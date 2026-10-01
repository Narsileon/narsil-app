<?php

declare(strict_types=1);

namespace App\View\Components\Contents;

#region USE

use Illuminate\View\Component;

#endregion

final class ContentRenderer extends Component
{
    #region CONSTRUCTOR

    /**
     * @param array<string,mixed> $content
     *
     * @return void
     */
    public function __construct(array $content)
    {
        $handle = $content['handle'] ?? null;

        $this->contentView = match ($handle)
        {
            'accordion' => 'components.contents.accordion.accordion-root',
            'button' => 'components.contents.button.button-root',
            'call_to_action' => 'components.contents.call-to-action.call-to-action-root',
            'form' => 'components.contents.form.form-root',
            'hero_header' => 'components.contents.hero-header.hero-header-root',
            default => null,
        };

        $this->contentData = $content['children'] ?? [];
        $this->nodeId = $content['uuid'] ?? null;

        $padding = $this->contentData['layout']['padding'] ?? [];

        $this->paddingBottom = is_string($padding['bottom'] ?? null) ? $padding['bottom'] : '';
        $this->paddingTop = is_string($padding['top'] ?? null) ? $padding['top'] : '';
    }

    #endregion

    #region PROPERTIES

    /**
     * @var array<string,mixed>
     */
    public readonly array $contentData;

    /**
     * @var string|null
     */
    public readonly ?string $contentView;

    /**
     * @var string|null
     */
    public readonly ?string $nodeId;

    /**
     * @var string
     */
    public readonly string $paddingBottom;

    /**
     * @var string
     */
    public readonly string $paddingTop;

    #endregion

    #region PUBLIC METHODS

    /**
     * @return string
     */
    public function render(): string
    {
        return 'components.contents.content-renderer';
    }

    #endregion
}
