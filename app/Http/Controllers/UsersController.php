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
        $user = ($id !== '0') ? User::findOrFail($id) : new User();
        if (isset(session('_old_input')['name'])) {
            $user->name = session('_old_input')['name'];
        }
        $userRole = session('_old_input')['role'] ? session('_old_input')['role'] : $user->getRole();
        $roles = Role::all()->pluck('name');
        return view('pages.users.edit', ['user' => $user, 'userRole' => $userRole, 'roles' => $roles]);
    }

    public function save(Request $request, $id)
    {
        $request->flashOnly(['name', 'role']);
        $this->validate($request, [
            'name' => 'required|max:255',
            'password' => 'required|confirmed',
            'role' => 'required'
        ]);

        // check that user name not exist
        $user = User::where('name', '=', Input::get('name'))
            ->where('id', '!=', $id)
            ->first();
        if ($user != null) {
            return redirect()->to('users/'.$id.'/edit')
                ->withErrors(['Username already exists.']);
        }

        // find the role for the user
        $role = Role::where('name', '=', Input::get('role'))->first();
        if ($role == null) {
            return redirect()->to('users/'.$id.'/edit')
                ->withErrors(['Invalid role.']);
        }

        // save user
        $user = ($id !== '0') ? User::findOrFail($id) : new User();
        $user->name = Input::get('name');
        $user->password = bcrypt(Input::get('password'));
        $user->saveOrFail();
        $user->detachRoles();
        $user->attachRole($role);

        return view('pages.users.index');
    }
}
