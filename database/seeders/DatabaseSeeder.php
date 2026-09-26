<?php

declare(strict_types=1);

namespace Database\Seeders;

#region USE

use Illuminate\Database\Seeder;
use Narsil\Cms\Database\Seeders\Templates\ContentTemplateSeeder;
use Narsil\Cms\Form\Database\Seeders\Blocks\FormBlockSeeder;
use Narsil\Cms\Jobs\SitemapJob;

#endregion

final class DatabaseSeeder extends Seeder
{
    #region PUBLIC METHODS

    /**
     * @return void
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
        ]);

        $formBlockSeeder = new FormBlockSeeder()
            ->run();

        new ContentTemplateSeeder([
            $formBlockSeeder,
        ])->run();

        $site = new SiteSeeder()
            ->run();

        SitemapJob::dispatchSync($site);
    }

    #endregion
}
