<?php

declare(strict_types=1);

namespace App\View\Components\Contents\Button;

#region USE

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

#endregion

final class ButtonRoot extends Component
{
    #region CONSTRUCTOR

    /**
     * @param array<string,mixed> $contentData
     * @param string|null $nodeId
     *
     * @return void
     */
    public function __construct(array $contentData, ?string $nodeId = null)
    {
        $this->contentData = $contentData;
        $this->link = is_array($contentData['link'] ?? null) ? $contentData['link'] : null;
        $this->nodeId = $nodeId;
    }

    #endregion

    #region PROPERTIES

    /**
     * @var array<string,mixed>
     */
    public readonly array $contentData;

    /**
     * @var array<string,mixed>|null
     */
    public readonly ?array $link;

    /**
     * @var string|null
     */
    public readonly ?string $nodeId;

    #endregion

    #region PUBLIC METHODS

    /**
     * @return View
     */
    public function render(): View
    {
        return view('components.contents.button.button-root');
    }

    #endregion
}
