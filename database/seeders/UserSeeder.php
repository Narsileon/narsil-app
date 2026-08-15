<?php

declare(strict_types=1);

namespace Database\Seeders;

#region USE

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Narsil\Base\Models\Policies\Role;
use Narsil\Base\Models\User;

#endregion

final class UserSeeder extends Seeder
{
    #region PUBLIC METHODS

    /**
     * @return void
     */
    public function run(): void
    {
        $role = $this->createSuperAdminRole();
        $user = $this->createSuperAdminUser();

        $user->roles()->sync($role->{Role::ID});
    }

    #endregion

    #region PRIVATE METHODS

    /**
     * @return Role
     */
    private function createSuperAdminRole(): Role
    {
        $role = Role::firstOrCreate([
            Role::NAME => 'super_admin',
        ], [
            Role::LABEL => 'Super Admin',
        ]);

        return $role;
    }

    /**
     * @return User
     */
    private function createSuperAdminUser(): User
    {
        $user = User::firstOrCreate([
            User::EMAIL => 'admin@narsil.io',
            User::FIRST_NAME => 'Admin',
            User::LAST_NAME => 'Super',
        ], [
            User::EMAIL_VERIFIED_AT => Carbon::now(),
            User::PASSWORD => '123456789',
        ]);

        return $user;
    }

    #endregion
}
