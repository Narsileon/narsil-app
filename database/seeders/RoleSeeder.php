<?php

namespace Database\Seeders;

#region USE

use Illuminate\Database\Seeder;
use Narsil\Policies\Models\Permission;
use Narsil\Policies\Models\Role;

#endregion

/**
 * @version 1.0.0
 *
 * @author Jonathan Rigaux
 */
final class RoleSeeder extends Seeder
{
    #region PUBLIC METHODS

    /**
     * @return void
     */
    public function run(): void
    {
        $this->createAdmin();
        $this->createSuperAdmin();
    }

    #endregion

    #region PRIVATE METHODS

    /**
     * @return void
     */
    private function createAdmin(): void
    {
        $role = Role::firstOrCreate([
            Role::NAME => 'admin',
        ], [
            Role::LABEL => 'admin',
            Role::LEVEL => 99,
        ]);

        $role->syncPermissions(Permission::all()->pluck(Permission::NAME)->toArray());
    }

    /**
     * @return void
     */
    private function createSuperAdmin(): void
    {
        $role = Role::firstOrCreate([
            Role::NAME => 'super-admin',

        ], [
            Role::LABEL => 'super-admin',
            Role::LEVEL => 999,
        ]);

        $role->syncPermissions(Permission::all()->pluck(Permission::NAME)->toArray());
    }

    #endregion
}
