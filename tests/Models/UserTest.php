<?php

namespace Test\Models;

use Test\TestCase;

class UserTest extends TestCase
{
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
