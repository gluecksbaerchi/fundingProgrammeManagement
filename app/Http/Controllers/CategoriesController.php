<?php
/**
 * Created by PhpStorm.
 * User: Carolin
 * Date: 09.11.2016
 * Time: 13:01
 */

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\FundingProgramme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class CategoriesController extends Controller
{
    public function show()
    {
        $categories = Category::all();
        return view('pages.categories.index', ['categories' => $categories]);
    }

    public function edit(Request $request, $id)
    {
        $parentCategories = Category::where('parent_id', '=', null)->where('id', '!=', $id)->get();
        $category = ($id !== '0') ? Category::findOrFail($id) : new Category();
        $category->fill($request->old());
        return view('pages.categories.edit', ['category' => $category, 'parentCategories' => $parentCategories]);
    }

    public function save(Request $request, $id)
    {
        $request->flash();
        $this->validate($request, [
            'name' => 'required|max:255'
        ]);

        $category = ($id !== '0') ? Category::findOrFail($id) : new Category();
        $category->fill(Input::all());
        if (Input::get('parent_id') == 0) {
            $category->parent_id = null;
        }
        $category->saveOrFail();

        \Session::flash('message', trans('categories.update_success'));
        return redirect()->to('categories');
    }

    public function delete(Category $category)
    {
        if ($this->categoryBelongsToFundingProgramme($category->id)) {
            return redirect()->to('categories')->withErrors([trans('error.category_not_deletable')]);
        }
        foreach ($category->children as $child) {
            if ($this->categoryBelongsToFundingProgramme($child->id)) {
                return redirect()->to('categories')->withErrors([trans('error.category_not_deletable')]);
            }
        }

        $category->delete();
        return redirect()->to('categories');
    }

    protected function categoryBelongsToFundingProgramme($categoryId)
    {
        $fundingProgramme = FundingProgramme::where('category_id', '=', $categoryId)->first();
        return $fundingProgramme != null;
    }
}
