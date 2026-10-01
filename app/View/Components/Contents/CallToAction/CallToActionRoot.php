<?php

declare(strict_types=1);

namespace App\View\Components\Contents\CallToAction;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

#endregion

final class CallToActionRoot extends Component
{
    #region CONSTRUCTOR

    /**
     * @param array<string,mixed> $contentData
     * @param string|null $nodeId
     * @param string $paddingBottom
     * @param string $paddingTop
     *
     * @return void
     */
    public function __construct(
        array $contentData,
        ?string $nodeId = null,
        string $paddingBottom = '',
        string $paddingTop = '',
    ) {
        $this->contentData = $contentData;
        $this->nodeId = $nodeId;
        $this->paddingBottom = $paddingBottom;
        $this->paddingTop = $paddingTop;
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
     * {@inheritDoc}
     */
    public function render(): View
    {
        return view('components.contents.call-to-action.call-to-action-root');
    }

    #endregion
}
