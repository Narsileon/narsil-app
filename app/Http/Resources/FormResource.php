<?php

declare(strict_types=1);

namespace App\Http\Resources;

#region USE

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;
use Narsil\Base\Support\TranslationsBag;
use Narsil\Cms\Form\Http\Data\Forms\FormStepData;
use Narsil\Cms\Form\Models\Form;
use Narsil\Cms\Form\Models\FormStep;

#endregion

final class FormResource extends JsonResource
{
    #region PUBLIC METHODS

    /**
     * @param Request $request
     *
     * @return array<string,mixed>
     */
    public function toArray(Request $request): array
    {
        app(TranslationsBag::class)
            ->add('narsil::tooltips.required')
            ->add('narsil::ui.next')
            ->add('narsil::ui.previous')
            ->add('ui.submit')
            ->add('ui.submited');

        $form = $this->resource;

        return [
            'id' => $form->{Form::ID},
            'slug' => $form->{Form::SLUG},
            'steps' => $form->{Form::RELATION_STEPS}->map(function (FormStep $step): array
            {
                return FormStepData::fromElement($step)->toArray();
            })->all(),
            'uuid' => Str::uuid7()->toString(),
        ];
    }

    #endregion
}
