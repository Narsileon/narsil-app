<?php

namespace App\Http\Data;

#region USE

use Narsil\Models\Forms\Input;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#endregion

#[TypeScript]
final class InputData extends Data
{
    #region CONSTRUCTOR

    /**
     * @param string $description
     * @param string $handle
     * @param string $label
     * @param object $settings
     * @param string $type
     * @param InputOptionData[] $options
     *
     * @return void
     */
    public function __construct(
        public string $description,
        public string $handle,
        public string $label,
        public object $settings,
        public string $type,
        public array $options,
    )
    {
        //
    }

    #endregion

    #region PUBLIC METHODS

    /**
     * @param Input $input
     *
     * @return static
     */
    public static function fromModel(Input $input): self
    {
        return new static(
            description: $input->{Input::DESCRIPTION},
            handle: $input->{Input::HANDLE},
            label: $input->{Input::LABEL},
            settings: $input->{Input::SETTINGS},
            type: $input->{Input::TYPE},

            options: $input->{Input::RELATION_OPTIONS}
                ->map(function ($option)
                {
                    return InputOptionData::from($option);
                })
                ->all(),
        );
    }

    #endregion
}
