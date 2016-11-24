<?php
/**
 * Created by PhpStorm.
 * User: Carolin
 * Date: 24.11.2016
 * Time: 13:38
 */

namespace Test\Controllers;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Test\BaseDataProvidersTrait;
use Test\TestCase;

class UsersControllerTest extends TestCase
{
    use DatabaseTransactions, BaseDataProvidersTrait;

    /**
     * @dataProvider roleDataProvider
     * @param $roleName
     * @param $permissions
     */
    public function test_create_new_user($roleName, $permissions)
    {
        $loggedInUser = $this->getUserWithRole($roleName);
        $validData = $this->getValidUserData();

        $countUsers = User::count();
        $this->dontSeeInDatabase('users', [
            'name' => $validData['name']
        ]);

        $this->actingAs($loggedInUser)->call(
            'POST',
            '/users/0/edit',
            $validData
        );

        $countUsers2 = User::count();
        if ($permissions['userManagement']) {
            $this->assertTrue($countUsers2 == ($countUsers+1));
            $this->seeInDatabase('users', [
                'name' => $validData['name']
            ]);
        } else {
            $this->assertTrue($countUsers2 == $countUsers);
            $this->dontSeeInDatabase('users', [
                'name' => $validData['name']
            ]);
        }
    }

    /**
     * @dataProvider roleDataProvider
     * @param $roleName
     * @param $permissions
     */
    public function test_update_user($roleName, $permissions)
    {
        $loggedInUser = $this->getUserWithRole($roleName);
        $validData = $this->getValidUserData();

        $category = factory(User::class)->create();

        $countUsers = User::count();
        $this->dontSeeInDatabase('users', [
            'name' => $validData['name']
        ]);

        $this->actingAs($loggedInUser)->call(
            'POST',
            '/users/'.$category->id.'/edit',
            $validData
        );

        $countUsers2 = User::count();
        if ($permissions['userManagement']) {
            $this->assertTrue($countUsers2 == ($countUsers));
            $this->seeInDatabase('users', [
                'name' => $validData['name']
            ]);
        } else {
            $this->assertTrue($countUsers2 == $countUsers);
            $this->dontSeeInDatabase('users', [
                'name' => $validData['name']
            ]);
        }
    }

    /**
     * @dataProvider roleDataProvider
     * @param $roleName
     * @param $permissions
     */
    public function test_delete_user($roleName, $permissions)
    {
        $user = factory(User::class)->create();

        $this->actingAs($this->getUserWithRole($roleName))->call(
            'GET',
            '/users/'.$user->id.'/delete'
        );

        if ($permissions['userManagement']) {
            $this->dontSeeInDatabase('users', [
                'name' => $user->name
            ]);
        } else {
            $this->seeInDatabase('users', [
                'name' => $user->name
            ]);
        }
    }

    public function test_not_possible_to_update_own_user()
    {
        // TODO: implement
    }

    public function test_not_possible_to_delete_own_user()
    {
        // TODO: implement
    }

    public function test_not_possible_to_save_user_with_existing_user_name()
    {
        // TODO: implement
    }

    public function test_edit_profile()
    {
        // TODO: implement
    }

    protected function getValidUserData()
    {
        return [
            'name' => 'Test User Name',
            'password' => '12345678',
            'password_confirmation' => '12345678',
            'role' => 'guest'
        ];
    }
}
