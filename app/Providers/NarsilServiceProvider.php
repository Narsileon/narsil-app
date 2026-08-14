<?php

declare(strict_types=1);

namespace App\Providers;

#region USE

use Illuminate\Support\ServiceProvider;
use Narsil\Base\Narsil;
use Narsil\Cms\Enums\SchemaEnum;
use Narsil\Cms\Form\ServiceProvider as CmsFormServiceProvider;
use Narsil\Cms\ServiceProvider as CmsServiceProvider;

#endregion

final class NarsilServiceProvider extends ServiceProvider
{
    #region PUBLIC METHODS

    /**
     * {@inheritDoc}
     */
    public function register(): void
    {
        $narsil = $this->app->make(Narsil::class);

        $narsil
            ->locales([
                'en',
                'de',
                'fr',
            ])
            ->schemas([
                SchemaEnum::LIVE->value,
                SchemaEnum::STAGE->value,
                SchemaEnum::DEV->value,
            ])
            ->plugins([
                CmsServiceProvider::class,
                CmsFormServiceProvider::class,
            ]);
    }

    #endregion
}
