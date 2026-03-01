<?php

namespace Database\Seeders;

#region USE

use Database\Seeders\SiteSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Database\Seeder;
use Narsil\Base\Traits\HasSchemas;
use Narsil\Cms\Database\Seeders\Templates\ContentTemplateSeeder;

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

            $this->call([
                ContentTemplateSeeder::class,
                SiteSeeder::class,
            ]);
        }
    }

    #endregion
}
