<?php

declare(strict_types=1);

namespace App\Http\Data;

#region USE

use Narsil\Cms\Models\Globals\Header;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#endregion

#[TypeScript]
final class HeaderData extends Data
{
    #region CONSTRUCTOR

    /**
     * @return void
     */
    public function __construct()
    {
        //
    }

    #endregion

    #region PUBLIC METHODS

    /**
     * @param Header $header
     *
     * @return static
     */
    public static function fromModel(Header $header): self
    {
        return new static();
    }

    #endregion
}
