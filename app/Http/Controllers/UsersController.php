<?php
/**
 * Created by PhpStorm.
 * User: Carolin
 * Date: 09.11.2016
 * Time: 13:01
 */

namespace App\Http\Controllers;

class UsersController extends Controller
{
    public function show()
    {
        return view('pages.users.index');
    }

    public function edit()
    {
        return view('pages.users.edit');
    }
}
