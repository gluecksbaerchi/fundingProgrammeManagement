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
        $contacts = Contact::all();
        return view('pages.contacts.index', ['contacts' => $contacts]);
    }

    public function edit(Request $request, $id)
    {
        $contact = ($id !== '0') ? Contact::findOrFail($id) : new Contact();
        $contact->fill($request->old());
        return view('pages.contacts.edit', ['contact' => $contact]);
    }

    public function save(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'email'
        ]);

        $contact = ($id !== '0') ? Contact::findOrFail($id) : new Contact();
        $contact->fill(Input::all());
        $contact->saveOrFail();

        if ($request->ajax()) {
            return json_encode($contact);
        }

        \Session::flash('message', trans('contacts.update_success'));
        return redirect()->to('contacts');
    }

    public function delete(Contact $contact)
    {
        $contact->delete();
        return redirect()->to('contacts');
    }
}
