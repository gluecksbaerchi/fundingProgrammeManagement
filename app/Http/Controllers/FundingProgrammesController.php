<?php
/**
 * Created by PhpStorm.
 * User: Carolin
 * Date: 09.11.2016
 * Time: 12:54
 */

namespace App\Http\Controllers;

use App\Models\Category;
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

    public function edit(Request $request, $id)
    {
        $targetWhatOptions = [
            trans('funding_programmes.costs.fee'),
            trans('funding_programmes.costs.material_costs'),
            trans('funding_programmes.costs.staff_costs'),
            trans('funding_programmes.costs.other')
        ];
        $categories = Category::all();
        $fundingProgramme = ($id !== '0') ? FundingProgramme::findOrFail($id) : new FundingProgramme();
        $fundingProgramme->fill($request->old());
        return view('pages.funding_programmes.edit', [
            'fundingProgramme' => $fundingProgramme,
            'targetWhatOptions' => $targetWhatOptions,
            'categories' => $categories
        ]);
    }

    public function save(Request $request, $id)
    {
        $request->flash();
        $this->validate($request, [
            'name' => 'required|max:255'
        ]);

        $fundingProgramme = ($id !== '0') ? FundingProgramme::findOrFail($id) : new FundingProgramme();
        $fundingProgramme->fill(Input::all());
        $fundingProgramme->user_id = \Auth::user()->id;
        $fundingProgramme->runtime_from =  new \DateTime(Input::get('runtime_from'));
        $fundingProgramme->runtime_to =  new \DateTime(Input::get('runtime_to'));
        $fundingProgramme->saveOrFail();

        return redirect()->to('funding_programmes');
    }

    public function delete(FundingProgramme $fundingProgramme)
    {

    }
}
