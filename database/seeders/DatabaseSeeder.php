<?php

declare(strict_types=1);

namespace Database\Seeders;

#region USE

use Database\Seeders\SiteSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Database\Seeder;
use Narsil\Base\Traits\HasSchemas;
use Narsil\Cms\Database\Seeders\Templates\ContentTemplateSeeder;
use Narsil\Cms\Form\Database\Seeders\Blocks\FormBlockSeeder;
use Narsil\Cms\Jobs\SitemapJob;

#endregion

final class DatabaseSeeder extends Seeder
{
    use HasSchemas;

    #region PUBLIC METHODS

    /**
     * @return void
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
        ]);

        foreach ($this->getSchemas() as $schema)
        {
            $this->setSearchPath($schema);

            $formBlockSeeder = (new FormBlockSeeder())->run();

            (new ContentTemplateSeeder([
                $formBlockSeeder,
            ]))->run();

            $site = (new SiteSeeder())->run();

            SitemapJob::dispatchSync($site, $schema);
        }
    }

    #endregion
}
