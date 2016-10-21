<?php

use Illuminate\Database\Seeder;

class AuthSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create roles
        $userRole = new \App\Models\Role();
        $userRole->name         = 'user';
        $userRole->display_name = 'Nutzer';
        $userRole->description  = 'Nutzer kann Förderprojekte ansehen und verwalten.';
        $userRole->save();

        $adminRole = new \App\Models\Role();
        $adminRole->name         = 'admin';
        $adminRole->display_name = 'Nutzer Administrator';
        $adminRole->description  = 'Nutzer kann andere Nutzer anlegen und verwalten.';
        $adminRole->save();

        // create admin user
        $user = new \App\Models\User();
        $user->name = 'admin';
        $user->password = bcrypt("admin");
        $user->email = "admin@test.de";
        $user->save();
        $user->attachRole($adminRole);

        // create permissions
        $viewFundingProgrammes = new \App\Models\Permission();
        $viewFundingProgrammes->name         = 'view-funding-programme';
        $viewFundingProgrammes->display_name = 'View Funding Programmes';
        $viewFundingProgrammes->description  = 'view funding programmes';
        $viewFundingProgrammes->save();

        $createFundingProgrammes = new \App\Models\Permission();
        $createFundingProgrammes->name         = 'create-funding-programme';
        $createFundingProgrammes->display_name = 'Create / Edit Funding Programme';
        $createFundingProgrammes->description  = 'create and edit funding programmes';
        $createFundingProgrammes->save();

        $editUser = new \App\Models\Permission();
        $editUser->name         = 'edit-user';
        $editUser->display_name = 'Edit / Create Users';
        $editUser->description  = 'edit existing users and create new users';
        $editUser->save();

        $userRole->attachPermissions([$viewFundingProgrammes, $createFundingProgrammes]);
        $adminRole->attachPermissions([$viewFundingProgrammes, $createFundingProgrammes, $editUser]);
    }
}
