<?php

namespace Database\Seeders;

#region USE

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

#endregion

/**
 * @version 1.0.0
 *
 * @author Jonathan Rigaux
 */
final class PermissionSeeder extends Seeder
{
    #region PUBLIC METHODS

    /**
     * @return void
     */
    public function run(): void
    {
        Artisan::call('narsil:sync-permissions');
    }

    #endregion
}
