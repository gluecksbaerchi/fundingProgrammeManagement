<?php
/**
 * Created by PhpStorm.
 * User: Carolin
 * Date: 09.11.2016
 * Time: 12:54
 */

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Contact;
use App\Models\FundingProgramme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class FundingProgrammesController extends Controller
{
    public function show()
    {
        $fundingProgrammes = FundingProgramme::all();
        return view('pages.funding_programmes.index', ['fundingProgrammes' => $fundingProgrammes]);
    }

    public function detail(FundingProgramme $fundingProgramme)
    {
        return view('pages.funding_programmes.detail', ['fundingProgramme' => $fundingProgramme]);
    }

    public function edit(Request $request, $id)
    {
        $targetWhatOptions = [
            trans('funding_programmes.costs.fee'),
            trans('funding_programmes.costs.material_costs'),
            trans('funding_programmes.costs.staff_costs'),
            trans('funding_programmes.costs.other')
        ];
        $categories = Category::all();
        $contacts = Contact::all();
        $fundingProgramme = ($id !== '0') ? FundingProgramme::findOrFail($id) : new FundingProgramme();
        $fundingProgramme->fill($request->old());
        return view('pages.funding_programmes.edit', [
            'fundingProgramme' => $fundingProgramme,
            'targetWhatOptions' => $targetWhatOptions,
            'categories' => $categories,
            'contacts' => $contacts
        ]);
    }

    public function save(Request $request, $id)
    {
        $request->flash();
        // todo: validation
        $this->validate($request, [
            'name' => 'required|max:255',
            'organisation' => 'required|max:255'
        ]);

        $fundingProgramme = ($id !== '0') ? FundingProgramme::findOrFail($id) : new FundingProgramme();
        $fundingProgramme->fill(Input::all());
        $fundingProgramme->user_id = \Auth::user()->id;
        $fundingProgramme->saveOrFail();

        return redirect()->to('funding_programmes');
    }

    public function delete(FundingProgramme $fundingProgramme)
    {
        $fundingProgramme->delete();
        return redirect()->to('funding_programmes');
    }
}
