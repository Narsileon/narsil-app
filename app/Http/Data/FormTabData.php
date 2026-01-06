<?php

namespace App\Http\Data;

#region USE

use Narsil\Models\Forms\FormTab;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#endregion

#[TypeScript]
final class FormTabData extends Data
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
     * @param FormTab $formTab
     *
     * @return static
     */
    public static function fromModel(FormTab $formTab): self
    {
        return new static(
            description: $formTab->{FormTab::DESCRIPTION},
            handle: $formTab->{FormTab::HANDLE},
            label: $formTab->{FormTab::LABEL},
            position: $formTab->{FormTab::POSITION},

            elements: $formTab->{FormTab::RELATION_ELEMENTS}
                ->map(function ($element)
                {
                    return FormElementData::from($element);
                })
                ->all(),
        );
    }

    #endregion
}
