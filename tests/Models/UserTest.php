<?php

namespace Test\Models;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Test\TestCase;

class UserTest extends TestCase
{
    use DatabaseTransactions;

    public function roleDataProvider()
    {
        return [
            ['employee'],
            ['admin'],
            ['guest']
        ];
    }

    /**
     * @dataProvider roleDataProvider
     * @param $roleName
     */
    public function test_get_role($roleName)
    {
        $user = $this->getUserWithRole($roleName);

        $this->assertEquals($roleName, $user->getRole()->name);
    }
}
