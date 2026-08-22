<?php

declare(strict_types=1);

namespace App\View\Components\Ui;

#region USE

use Illuminate\View\Component;

#endregion

final class Heading extends Component
{
    #region CONSTRUCTOR

    /**
     * @param string $level
     * @param string $variant
     *
     * @return void
     */
    public function __construct(string $level = 'h1', string $variant = 'h6')
    {
        $this->level = $this->validateLevel($level);
        $this->variant = $this->validateVariant($variant);
    }

    #endregion

    #region PROPERTIES

    /**
     * @var string
     */
    public readonly string $level;

    /**
     * @var string
     */
    public readonly string $variant;

    #endregion

    #region PUBLIC METHODS

    /**
     * @return string
     */
    public function render(): string
    {
        return 'components.ui.heading';
    }

    #endregion

    #region PRIVATE METHODS

    /**
     * @param string $level
     *
     * @return string
     */
    private function validateLevel(string $level): string
    {
        return match ($level)
        {
            'h1', 'h2', 'h3', 'h4', 'h5', 'h6' => $level,
            default => 'h1',
        };
    }

    /**
     * @param string $variant
     *
     * @return string
     */
    private function validateVariant(string $variant): string
    {
        return match ($variant)
        {
            'h1', 'h2', 'h3', 'h4', 'h5', 'h6' => $variant,
            default => 'h6',
        };
    }

    #endregion
}
