<?php

declare(strict_types=1);

namespace App\View\Components\Block;

#region USE

use Illuminate\View\Component;

#endregion

final class HeroHeader extends Component
{
    #region CONSTRUCTOR

    /**
     * @param array<string,mixed> $data
     * @param string|null $nodeId
     * @param string $paddingBottom
     * @param string $paddingTop
     *
     * @return void
     */
    public function __construct(
        array $data,
        ?string $nodeId = null,
        string $paddingBottom = '',
        string $paddingTop = '',
    )
    {
        $this->blockData = $data;
        $this->nodeId = $nodeId;
        $this->paddingBottom = $paddingBottom;
        $this->paddingTop = $paddingTop;
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
        return 'components.block.hero-header';
    }

    #endregion
}
