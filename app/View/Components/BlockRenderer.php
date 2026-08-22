<?php

declare(strict_types=1);

namespace App\View\Components;

#region USE

use Illuminate\View\Component;

#endregion

final class BlockRenderer extends Component
{
    #region CONSTRUCTOR

    /**
     * @param array<string,mixed> $block
     * @return void
     */
    public function __construct(array $block)
    {
        $handle = $block['handle'] ?? null;

        $this->blockView = match ($handle)
        {
            'accordion' => 'components.block.accordion',
            'button' => 'components.block.button',
            'call_to_action' => 'components.block.call-to-action',
            'form' => 'components.block.form',
            'hero_header' => 'components.block.hero-header',
            default => null,
        };

        $this->blockData = $block['children'] ?? [];
        $this->nodeId = $block['uuid'] ?? null;

        $padding = $this->blockData['layout']['padding'] ?? [];

        $this->paddingBottom = is_string($padding['bottom'] ?? null) ? $padding['bottom'] : '';
        $this->paddingTop = is_string($padding['top'] ?? null) ? $padding['top'] : '';
    }

    #endregion

    #region PROPERTIES

    /**
     * @var array<string,mixed>
     */
    public readonly array $blockData;

    /**
     * @var string|null
     */
    public readonly ?string $blockView;

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
        return 'components.block-renderer';
    }

    #endregion
}
