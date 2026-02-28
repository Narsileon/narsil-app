<?php

namespace Database\Seeders;

#region USE

use Database\Seeders\SiteSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Database\Seeder;
use Narsil\Cms\Database\Seeders\Templates\ContentTemplateSeeder;

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
            ContentTemplateSeeder::class,
            SiteSeeder::class,
        ]);
    }

    #endregion
}
