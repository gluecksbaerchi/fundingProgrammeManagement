<?php
/**
 * Created by PhpStorm.
 * User: Carolin
 * Date: 13.11.2016
 * Time: 16:31
 */

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class ContactsController extends Controller
{
    public function show()
    {

    }

    public function edit(Request $request, $id)
    {

    }

    public function save(Request $request, $id)
    {
        // todo: validation
        $this->validate($request, [
            'name' => 'required|max:255'
        ]);

        $contact = ($id !== '0') ? Contact::findOrFail($id) : new Contact();
        $contact->fill(Input::all());
        $contact->saveOrFail();

        return json_encode($contact);
    }

    public function delete(Contact $contact)
    {

    }
}
