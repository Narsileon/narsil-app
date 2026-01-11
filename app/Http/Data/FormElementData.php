<?php

namespace App\Http\Data;

#region USE

use Narsil\Interfaces\IFormElement;
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
     * @param IFormElement $formElement
     *
     * @return static
     */
    public static function fromModel(IFormElement $formElement): self
    {
        $base = $formElement->{IFormElement::RELATION_BASE};

        $baseData = match ($formElement->{IFormElement::BASE_TYPE})
        {
            Fieldset::TABLE => FieldsetData::fromModel($base),
            Input::TABLE => InputData::fromModel($base),
        };

        return new static(
            description: $formElement->{IFormElement::DESCRIPTION},
            handle: $formElement->{IFormElement::HANDLE},
            label: $formElement->{IFormElement::LABEL},
            position: $formElement->{IFormElement::POSITION},
            required: $formElement->{IFormElement::REQUIRED},
            width: $formElement->{IFormElement::WIDTH},

            conditions: $formElement->{IFormElement::RELATION_CONDITIONS}
                ->map(function ($condition)
                {
                    return FormElementConditionData::from($condition);
                })
                ->all(),
            base: $baseData,
        );
    }

    #endregion
}
