<?php

namespace Database\Seeders;

#region USE

use Illuminate\Database\Seeder;

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
            PermissionSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
        ]);
    }

    #endregion
}
