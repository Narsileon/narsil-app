<?php

namespace App\Http\Data;

#region USE

use Narsil\Models\Forms\Element;
use Narsil\Models\Forms\Fieldset;
use Narsil\Models\Forms\Input;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#endregion

#[TypeScript]
final class FormElementData extends Data
{
    #region CONSTRUCTOR

    /**
     * @param string $description
     * @param string $handle
     * @param string $label
     * @param integer $position
     * @param boolean $required
     * @param integer $width
     * @param FormElementConditionData[] $conditions
     * @param FieldsetData|InputData $base
     *
     * @return void
     */
    public function __construct(
        public string $description,
        public string $handle,
        public string $label,
        public int $position,
        public bool $required,
        public int $width,
        public array $conditions,
        public FieldsetData|InputData $base,
    )
    {
        //
    }

    #endregion

    #region PUBLIC METHODS

    /**
     * @param Element $element
     *
     * @return static
     */
    public static function fromModel(Element $element): self
    {
        $base = $element->{Element::RELATION_BASE};

        $baseData = match ($element->{Element::BASE_TYPE})
        {
            Fieldset::TABLE => FieldsetData::fromModel($base),
            Input::TABLE => InputData::fromModel($base),
        };

        return new static(
            base: $baseData,
            conditions: $element->{Element::RELATION_CONDITIONS}
                ->map(function ($condition)
                {
                    return FormElementConditionData::from($condition);
                })
                ->all(),
            description: $element->{Element::DESCRIPTION},
            handle: $element->{Element::HANDLE},
            label: $element->{Element::LABEL},
            position: $element->{Element::POSITION},
            required: $element->{Element::REQUIRED},
            width: $element->{Element::WIDTH},
        );
    }

    #endregion
}
