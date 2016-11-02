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
        $guestRole = new \App\Models\Role();
        $guestRole->name         = 'guest';
        $guestRole->display_name = 'Guest';
        $guestRole->description  = 'can only see funding programmes and categories';
        $guestRole->save();

        $employeeRole = new \App\Models\Role();
        $employeeRole->name         = 'employee';
        $employeeRole->display_name = 'Employee';
        $employeeRole->description = 'is allowed to create/edit funding programmes and categories';
        $employeeRole->save();

        $adminRole = new \App\Models\Role();
        $adminRole->name         = 'admin';
        $adminRole->display_name = 'Admin';
        $adminRole->description  = 'is allowed to create and edit users, delete funding programmes and categories';
        $adminRole->save();

        // create admin user
        $user = new \App\Models\User();
        $user->name = 'admin';
        $user->password = bcrypt("admin");
        $user->email = "admin@test.de";
        $user->save();
        $user->attachRole($adminRole);

        // create permissions
        /******************************************
         * FUNDING PROGRAMMES
         ******************************************/
        $viewFundingProgrammes = new \App\Models\Permission();
        $viewFundingProgrammes->name         = 'view-funding-programmes';
        $viewFundingProgrammes->display_name = 'View Funding Programmes';
        $viewFundingProgrammes->description  = 'view funding programmes';
        $viewFundingProgrammes->save();

        $createFundingProgrammes = new \App\Models\Permission();
        $createFundingProgrammes->name         = 'create-funding-programmes';
        $createFundingProgrammes->display_name = 'Create / Edit Funding Programme';
        $createFundingProgrammes->description  = 'create and edit funding programmes';
        $createFundingProgrammes->save();

        $deleteFundingProgrammes = new \App\Models\Permission();
        $deleteFundingProgrammes->name         = 'delete-funding-programmes';
        $deleteFundingProgrammes->display_name = 'Delete Funding Programme';
        $deleteFundingProgrammes->description  = 'delete funding programmes';
        $deleteFundingProgrammes->save();

        /******************************************
         * CATEGORIES
         ******************************************/
        $viewCategories = new \App\Models\Permission();
        $viewCategories->name         = 'view-categories';
        $viewCategories->display_name = 'View Categories';
        $viewCategories->description  = 'view categories';
        $viewCategories->save();

        $createCategories = new \App\Models\Permission();
        $createCategories->name         = 'create-categories';
        $createCategories->display_name = 'Create / Edit Categories';
        $createCategories->description  = 'create and edit categories';
        $createCategories->save();

        $deleteCategories = new \App\Models\Permission();
        $deleteCategories->name         = 'delete-categories';
        $deleteCategories->display_name = 'Delete Categories';
        $deleteCategories->description  = 'delete categories';
        $deleteCategories->save();

        /******************************************
         * USER HANDLING
         ******************************************/
        $editUser = new \App\Models\Permission();
        $editUser->name         = 'user-management';
        $editUser->display_name = 'View / Delete / Edit / Create Users';
        $editUser->description  = 'view all users, edit or delete existing users and create new users';
        $editUser->save();

        $editProfile = new \App\Models\Permission();
        $editProfile->name         = 'edit-profile';
        $editProfile->display_name = 'Edit Profile';
        $editProfile->description  = 'edit own user data';
        $editProfile->save();

        $guestRole->attachPermissions([
            $viewFundingProgrammes,
            $viewCategories,
            $editProfile
        ]);
        $employeeRole->attachPermissions([
            $viewFundingProgrammes,
            $createFundingProgrammes,
            $viewCategories,
            $createCategories,
            $editProfile
        ]);
        $adminRole->attachPermissions([
            $viewFundingProgrammes,
            $createFundingProgrammes,
            $deleteFundingProgrammes,
            $viewCategories,
            $createCategories,
            $deleteCategories,
            $editUser,
            $editProfile
        ]);
    }
}
