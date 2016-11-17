<?php
namespace Test;

use App\Models\Role;
use App\Models\User;
use Illuminate\Contracts\Console\Kernel;

abstract class TestCase extends \Illuminate\Foundation\Testing\TestCase
{
    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://localhost';

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Kernel::class)->bootstrap();

        return $app;
    }

    /**
     * @return User
     */
    protected function getUserWithRole($roleName)
    {
        $role = Role::where('name', '=', $roleName)->first();
        $user = factory(User::class)->create();
        $user->attachRole($role);
        return $user;
    }

    /**
     * @param $object
     * @param $methodName
     * @param $args
     * @return mixed
     */
    protected function callProtectedMethod($object, $methodName, $args = [])
    {
        $reflection = new \ReflectionClass(get_class($object));
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);
        return $method->invokeArgs($object, $args);
    }
}
