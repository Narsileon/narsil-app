<?php

declare(strict_types=1);

namespace App\View\Components;

#region USE

use Illuminate\View\Component;

#endregion

final class Button extends Component
{
    #region CONSTRUCTOR

    /**
     * @param array<string,mixed> $data
     * @param string|null $nodeId
     *
     * @return void
     */
    public function __construct(array $data, ?string $nodeId = null)
    {
        $this->blockData = $data;
        $this->link = is_array($data['link'] ?? null) ? $data['link'] : null;
        $this->nodeId = $nodeId;
    }

    #endregion

    #region PROPERTIES

    /**
     * @var array<string,mixed>
     */
    public readonly array $blockData;

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
     * @return string
     */
    public function render(): string
    {
        return 'components.button';
    }

    #endregion
}
