<?php

namespace Database\Seeders;

#region USE

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Narsil\Auth\Models\User as BaseUser;

#endregion

/**
 * @version 1.0.0
 *
 * @author Jonathan Rigaux
 */
final class UserSeeder extends Seeder
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
        $user = User::firstOrCreate([
            BaseUser::EMAIL => 'admin@test.com',
            BaseUser::FIRST_NAME => 'Admin',
            BaseUser::LAST_NAME => 'Standard',
            BaseUser::USERNAME => 'Standard-Admin',
        ], [
            BaseUser::ACTIVE => true,
            BaseUser::EMAIL_VERIFIED_AT => Carbon::now(),
            BaseUser::PASSWORD => '123456789',
        ]);

        $user->syncRoles('admin');
    }

    /**
     * @return void
     */
    private function createSuperAdmin(): void
    {
        $user = User::firstOrCreate([
            BaseUser::EMAIL => 'super-admin@test.com',
            BaseUser::FIRST_NAME => 'Admin',
            BaseUser::LAST_NAME => 'Super',
            BaseUser::USERNAME => 'Super-Admin',
        ], [
            BaseUser::ACTIVE => true,
            BaseUser::EMAIL_VERIFIED_AT => Carbon::now(),
            BaseUser::PASSWORD => '123456789',
        ]);

        $user->syncRoles('super_admin');
    }

    #endregion
}
