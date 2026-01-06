<?php

namespace App\Http\Data;

#region USE

use Narsil\Interfaces\IFormHasElement;
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
     * @param FieldsetData|InputData $element
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
        public FieldsetData|InputData $element,
    )
    {
        //
    }

    #endregion

    #region PUBLIC METHODS

    /**
     * @param IFormHasElement $formElement
     *
     * @return static
     */
    public static function fromModel(IFormHasElement $formElement): self
    {
        $element = $formElement->{IFormHasElement::RELATION_ELEMENT};

        $elementData = match ($formElement->{IFormHasElement::ELEMENT_TYPE})
        {
            Fieldset::TABLE => FieldsetData::fromModel($element),
            Input::TABLE => InputData::fromModel($element),
        };

        return new static(
            description: $formElement->{IFormHasElement::DESCRIPTION},
            handle: $formElement->{IFormHasElement::HANDLE},
            label: $formElement->{IFormHasElement::LABEL},
            position: $formElement->{IFormHasElement::POSITION},
            required: $formElement->{IFormHasElement::REQUIRED},
            width: $formElement->{IFormHasElement::WIDTH},

            conditions: $formElement->{IFormHasElement::RELATION_CONDITIONS}
                ->map(function ($condition)
                {
                    return FormElementConditionData::from($condition);
                })
                ->all(),
            element: $elementData,
        );
    }

    #endregion
}
