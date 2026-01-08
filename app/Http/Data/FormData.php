<?php

namespace App\Http\Data;

#region USE

use Narsil\Models\Forms\Form;
use Narsil\Support\TranslationsBag;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#endregion

#[TypeScript]
final class FormData extends Data
{
    #region CONSTRUCTOR

    /**
     * @param integer $id
     * @param string $slug
     * @param FormTabData[] $tabs
     *
     * @return void
     */
    public function __construct(
        public int $id,
        public string $slug,
        public array $tabs,
    )
    {
        app(TranslationsBag::class)
            ->add('ui.next')
            ->add('ui.previous')
            ->add('ui.required')
            ->add('ui.submit')
            ->add('ui.submited');
    }

    #endregion

    #region PUBLIC METHODS

    /**
     * @param Form $form
     *
     * @return static
     */
    public static function fromModel(Form $form): self
    {
        return new static(
            id: $form->{Form::ID},
            slug: $form->{Form::SLUG},

            tabs: $form->{Form::RELATION_TABS}
                ->map(function ($tab)
                {
                    return FormTabData::from($tab);
                })
                ->all(),
        );
    }

    #endregion
}
