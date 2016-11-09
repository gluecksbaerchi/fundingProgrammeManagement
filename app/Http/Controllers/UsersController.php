<?php
/**
 * Created by PhpStorm.
 * User: Carolin
 * Date: 09.11.2016
 * Time: 13:01
 */

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class UsersController extends Controller
{
    public function show()
    {
        return view('pages.users.index');
    }

    public function edit($id)
    {
        $user = new User();
        if ($id !== '0') {
            $user = User::findOrFail($id);
        }
        $user->name = session('_old_input')['name'];
        $userRole = session('_old_input')['role'] ? session('_old_input')['role'] : $user->getRole();
        $roles = Role::all()->pluck('name');
        return view('pages.users.edit', ['user' => $user, 'userRole' => $userRole, 'roles' => $roles]);
    }

    public function save(Request $request, $id)
    {
        // todo: save role and show error if user name already exist

        $request->flashOnly(['name', 'role']);

        $this->validate($request, [
            'name' => 'required|max:255',
            'password' => 'required|confirmed',
            'role' => 'required'
        ]);

        $user = new User();
        if ($id !== '0') {
            $user = User::findOrFail($id);
        }
        $user->fill(Input::all());
        $user->saveOrFail();

        return view('pages.users.index');
    }
}
