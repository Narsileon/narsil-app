<?php

namespace App\Http\Data;

#region USE

use Narsil\Models\Forms\FormStep;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#endregion

#[TypeScript]
final class FormStepData extends Data
{
    #region CONSTRUCTOR

    /**
     * @param string $description
     * @param string $handle
     * @param string $label
     * @param integer $position
     * @param FormElementData[] $elements
     *
     * @return void
     */
    public function __construct(
        public string $description,
        public string $handle,
        public string $label,
        public int $position,
        public array $elements,
    )
    {
        //
    }

    #endregion

    #region PUBLIC METHODS

    /**
     * @param FormStep $formStep
     *
     * @return static
     */
    public static function fromModel(FormStep $formStep): self
    {
        return new static(
            description: $formStep->{FormStep::DESCRIPTION},
            elements: $formStep->{FormStep::RELATION_ELEMENTS}
                ->map(function ($element)
                {
                    return FormElementData::from($element);
                })
                ->all(),
            handle: $formStep->{FormStep::HANDLE},
            label: $formStep->{FormStep::LABEL},
            position: $formStep->{FormStep::POSITION},
        );
    }

    #endregion
}
