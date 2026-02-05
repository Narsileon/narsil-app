<?php

namespace App\Http\Data;

#region USE

use Narsil\Cms\Models\Forms\InputOption;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#endregion

#[TypeScript]
final class InputOptionData extends Data
{
    #region CONSTRUCTOR

    /**
     * @param string $label
     * @param string $value
     *
     * @return void
     */
    public function __construct(
        public string $label,
        public string $value,
    )
    {
        //
    }

    #endregion

    #region PUBLIC METHODS

    /**
     * @param InputOption $inputOption
     *
     * @return static
     */
    public static function fromModel(InputOption $inputOption): self
    {
        return new static(
            label: $inputOption->{InputOption::LABEL},
            value: $inputOption->{InputOption::VALUE},
        );
    }

    #endregion
}
