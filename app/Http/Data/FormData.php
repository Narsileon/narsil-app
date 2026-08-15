<?php

declare(strict_types=1);

namespace App\Http\Data;

#region USE

use Illuminate\Support\Str;
use Narsil\Base\Support\TranslationsBag;
use Narsil\Cms\Form\Http\Data\Forms\FormStepData;
use Narsil\Cms\Form\Models\Form;
use Narsil\Cms\Form\Models\FormStep;
use Spatie\LaravelData\Attributes\Computed;
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
     * @param FormStepData[] $steps
     *
     * @return void
     */
    public function __construct(
        public int $id,
        public string $slug,
        public array $steps,
    )
    {
        $this->uuid = Str::uuid7();

        app(TranslationsBag::class)
            ->add('narsil::tooltips.required')
            ->add('narsil::ui.next')
            ->add('narsil::ui.previous')
            ->add('ui.submit')
            ->add('ui.submited');
    }

    #endregion

    #region PROPERTIES

    #[Computed]
    public string $uuid;

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
            steps: $form->{Form::RELATION_STEPS}
                ->map(function (FormStep $formStep)
                {
                    return FormStepData::fromElement($formStep);
                })
                ->all(),
        );
    }

    #endregion
}
