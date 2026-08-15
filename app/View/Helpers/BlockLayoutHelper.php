<?php

declare(strict_types=1);

namespace App\View\Helpers;

final class BlockLayoutHelper
{
    #region PUBLIC METHODS

    /**
     * @param array<string,mixed> $padding
     *
     * @return array{paddingTop:string,paddingBottom:string}
     */
    public function padding(array $padding): array
    {
        return [
            'paddingTop' => $this->classes('pt', $padding['top'] ?? null),
            'paddingBottom' => $this->classes('pb', $padding['bottom'] ?? null),
        ];
    }

    #endregion

    #region PRIVATE METHODS

    /**
     * @param string $direction
     * @param mixed $size
     *
     * @return string
     */
    private function classes(string $direction, mixed $size): string
    {
        return match ($size)
        {
            'sm' => "$direction-4 md:$direction-6 lg:$direction-8 xl:$direction-10",
            'md' => "$direction-8 md:$direction-12 lg:$direction-16 xl:$direction-20",
            'lg' => "$direction-16 md:$direction-24 lg:$direction-32 xl:$direction-40",
            default => '',
        };
    }

    #endregion
}
