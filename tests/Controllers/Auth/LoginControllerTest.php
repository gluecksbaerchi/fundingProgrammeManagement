<?php

namespace Test\Controllers\Auth;

use App\Models\User;
use Test\TestCase;

class LoginControllerTest extends TestCase
{
    public function test_login_success()
    {
        $user = factory(User::class)->create();
        $loginData = [
            'name' => $user->name,
            'password' => '12345678'
        ];

        $this->call(
            'POST',
            '/login',
            $loginData
        );

        $this->assertRedirectedTo('funding_programmes');
    }

    public function test_login_failed_with_wrong_username()
    {
        $user = factory(User::class)->create();
        $loginData = [
            'name' => 'wrong'.$user->name,
            'password' => '12345678'
        ];

        $this->call(
            'POST',
            '/login',
            $loginData
        );

        $this->assertRedirectedTo('/');
        $this->assertSessionHasErrors('name');
    }

    public function test_login_failed_with_wrong_password()
    {
        $user = factory(User::class)->create();
        $loginData = [
            'name' => $user->name,
            'password' => '123456789'
        ];

        $this->call(
            'POST',
            '/login',
            $loginData
        );

        $this->assertRedirectedTo('/');
        $this->assertSessionHasErrors('name');
    }
}
