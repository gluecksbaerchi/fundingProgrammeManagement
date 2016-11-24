<?php
/**
 * Created by PhpStorm.
 * User: Carolin
 * Date: 24.11.2016
 * Time: 13:38
 */

namespace Test\Controllers;

use App\Models\Category;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Test\BaseDataProvidersTrait;
use Test\TestCase;

class CategoriesControllerTest extends TestCase
{
    use DatabaseTransactions, BaseDataProvidersTrait;

    /**
     * @dataProvider roleDataProvider
     * @param $roleName
     * @param $permissions
     */
    public function test_create_new_category($roleName, $permissions)
    {
        $validData = $this->getValidCategoryData();

        $countCategories = Category::count();
        $this->dontSeeInDatabase('categories', [
            'name' => $validData['name']
        ]);

        $this->actingAs($this->getUserWithRole($roleName))->call(
            'POST',
            '/categories/0/edit',
            $validData
        );

        $countCategories2 = Category::count();
        if ($permissions['createCategory']) {
            $this->assertTrue($countCategories2 == ($countCategories+1));
            $this->seeInDatabase('categories', [
                'name' => $validData['name']
            ]);
        } else {
            $this->assertTrue($countCategories2 == $countCategories);
            $this->dontSeeInDatabase('categories', [
                'name' => $validData['name']
            ]);
        }
    }

    /**
     * @dataProvider roleDataProvider
     * @param $roleName
     * @param $permissions
     */
    public function test_update_category($roleName, $permissions)
    {
        $validData = $this->getValidCategoryData();

        $category = factory(Category::class)->create();

        $countCategories = Category::count();
        $this->dontSeeInDatabase('categories', [
            'name' => $validData['name']
        ]);

        $this->actingAs($this->getUserWithRole($roleName))->call(
            'POST',
            '/categories/'.$category->id.'/edit',
            $validData
        );

        $countCategories2 = Category::count();
        if ($permissions['createCategory']) {
            $this->assertTrue($countCategories2 == ($countCategories));
            $this->seeInDatabase('categories', [
                'name' => $validData['name']
            ]);
        } else {
            $this->assertTrue($countCategories2 == $countCategories);
            $this->dontSeeInDatabase('categories', [
                'name' => $validData['name']
            ]);
        }
    }

    /**
     * @dataProvider roleDataProvider
     * @param $roleName
     * @param $permissions
     */
    public function test_delete_category($roleName, $permissions)
    {
        $category = factory(Category::class)->create();

        $this->actingAs($this->getUserWithRole($roleName))->call(
            'GET',
            '/categories/'.$category->id.'/delete'
        );

        if ($permissions['deleteCategory']) {
            $this->dontSeeInDatabase('categories', [
                'name' => $category->name
            ]);
        } else {
            $this->seeInDatabase('categories', [
                'name' => $category->name
            ]);
        }
    }

    protected function getValidCategoryData()
    {
        return [
            'name' => 'Test Category'
        ];
    }
}
