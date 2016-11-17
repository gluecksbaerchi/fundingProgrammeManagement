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
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class FundingProgrammesController extends Controller
{
    public function show()
    {
        $targetWhatOptions = $this->getTargetWhatOptions();
        $categories = Category::all();
        $fundingProgrammes = FundingProgramme::actual()->get();
        return view('pages.funding_programmes.index', [
            'fundingProgrammes' => $fundingProgrammes,
            'targetWhatOptions' => $targetWhatOptions,
            'categories' => $categories
        ]);
    }

    public function detail(FundingProgramme $fundingProgramme)
    {
        return view('pages.funding_programmes.detail', ['fundingProgramme' => $fundingProgramme]);
    }

    public function edit(Request $request, $id)
    {
        $targetWhatOptions = $this->getTargetWhatOptions();
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
        $this->validate($request, [
            'category_id' => 'required',
            'name' => 'required|max:255',
            'organisation' => 'required|max:255',
            'runtime_from' => 'date',
            'runtime_to' => 'date|after:runtime_from'
        ]);

        $fundingProgramme = ($id !== '0') ? FundingProgramme::findOrFail($id) : new FundingProgramme();
        $fundingProgramme->fill(Input::all());
        $fundingProgramme->user_id = \Auth::user()->id;
        $fundingProgramme->saveOrFail();

        \Session::flash('message', trans('funding_programmes.update_success'));
        return redirect()->to('funding_programmes');
    }

    public function delete(FundingProgramme $fundingProgramme)
    {
        $fundingProgramme->delete();
        return redirect()->to('funding_programmes');
    }

    public function filter()
    {
        $targetWhat = Input::get('target_what');
        $categoryIds = Input::get('category_id');
        session([
            'category_filter' => $categoryIds,
            'target_what_filter' => $targetWhat
        ]);
        $fundingProgrammes = $this->getFilteredFundingProgrammes($categoryIds, $targetWhat);
        return view('pages.funding_programmes.table', ['fundingProgrammes' => $fundingProgrammes]);
    }

    protected function getTargetWhatOptions()
    {
        return [
            trans('funding_programmes.costs.fee'),
            trans('funding_programmes.costs.material_costs'),
            trans('funding_programmes.costs.staff_costs'),
            trans('funding_programmes.costs.other')
        ];
    }

    /**
     * @param $categoryIds
     * @param $targetWhat
     * @return Collection
     */
    protected function getFilteredFundingProgrammes($categoryIds, $targetWhat)
    {
        $fundingProgrammes = FundingProgramme::actual();
        if (count($categoryIds) > 0) {
            foreach ($categoryIds as $id) {
                $categoryIds = array_merge($categoryIds, Category::find($id)->children()->pluck('id')->toArray());
            }
            $fundingProgrammes->whereIn('category_id', $categoryIds);
        }
        if (count($targetWhat) > 0) {
            $fundingProgrammes->where(function ($query) use ($targetWhat) {
                $i = 1;
                foreach ($targetWhat as $value) {
                    if ($i === 1) {
                        $query->where('target_what', 'like', '%' . $value . '%');
                        $i++;
                    } else {
                        $query->orWhere('target_what', 'like', '%' . $value . '%');
                    }
                }
            });
        }
        return $fundingProgrammes->get();
    }
}
