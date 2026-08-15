<?php

declare(strict_types=1);

namespace App\View\Components;

#region USE

use App\View\Helpers\BlockLayoutHelper;
use Illuminate\View\Component;

#endregion

final class BlockRenderer extends Component
{
    #region CONSTRUCTOR

    /**
     * @param array<string,mixed> $block
     * @param BlockLayoutHelper $layoutHelper
     *
     * @return void
     */
    public function __construct(array $block, BlockLayoutHelper $layoutHelper)
    {
        $handle = $block['handle'] ?? null;

        $this->blockView = match ($handle)
        {
            'accordion' => 'components.accordion',
            'button' => 'components.button',
            'call_to_action' => 'components.call-to-action',
            'form' => 'components.form',
            'hero_header' => 'components.hero-header',
            default => null,
        };

        $this->blockData = $block['children'] ?? [];
        $this->nodeId = $block['uuid'] ?? null;

        $layout = $layoutHelper->padding($this->blockData['layout']['padding'] ?? []);

        $this->paddingBottom = $layout['paddingBottom'];
        $this->paddingTop = $layout['paddingTop'];
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
