<?php

namespace App\Http\Data;

#region USE

use Narsil\Models\Forms\Fieldset;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#endregion

#[TypeScript]
final class FieldsetData extends Data
{
    #region CONSTRUCTOR

    /**
     * @param string $handle
     * @param string $label
     * @param FormElementData[] $elements
     *
     * @return void
     */
    public function __construct(
        public string $handle,
        public string $label,
        public array $elements,
    )
    {
        //
    }

    #endregion

    #region PUBLIC METHODS

    /**
     * @param Fieldset $fieldset
     *
     * @return static
     */
    public static function fromModel(Fieldset $fieldset): self
    {
        return new static(
            elements: $fieldset->{Fieldset::RELATION_ELEMENTS}
                ->map(function ($element)
                {
                    return FormElementData::from($element);
                })
                ->all(),
            handle: $fieldset->{Fieldset::HANDLE},
            label: $fieldset->{Fieldset::LABEL},
        );
    }

    #endregion
}
