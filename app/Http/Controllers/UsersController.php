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
        $users = User::all();
        return view('pages.users.index', ['users' => $users]);
    }

    public function edit(Request $request, $id)
    {
        $user = ($id !== '0') ? User::findOrFail($id) : new User();
        if ($request->old('name')) {
            $user->name = $request->old('name');
        }
        $userRole = $request->old('role') ? $request->old('role') : $user->getRole()->name;
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
                ->withErrors([trans('error.duplicate_username')]);
        }

        // find the role for the user
        $role = Role::where('name', '=', Input::get('role'))->first();
        if ($role == null) {
            return redirect()->to('users/'.$id.'/edit')
                ->withErrors([trans('error.invalid_role')]);
        }

        // save user
        $user = ($id !== '0') ? User::findOrFail($id) : new User();
        $user->name = Input::get('name');
        $user->password = bcrypt(Input::get('password'));
        $user->saveOrFail();
        $user->detachRoles();
        $user->attachRole($role);

        return redirect()->to('users');
    }

    public function delete(User $user)
    {
        if (\Auth::user()->id == $user->id) {
            return redirect()->to('users')
                ->withErrors([trans('error.not_allowed_delete_own_user')]);
        }

        $user->detachRoles();
        $user->delete();

        return redirect()->to('users');
    }
}
