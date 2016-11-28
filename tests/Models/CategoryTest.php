<?php

namespace Test\Models;

use App\Models\Category;
use Test\TestCase;

class CategoryTest extends TestCase
{
    public function test_get_parent_returns_parent()
    {
        $category = factory(Category::class)->create();
        $categoryChild = factory(Category::class)->create();
        $categoryChild->parent_id = $category->id;
        $categoryChild->save();

        $this->assertEquals($category->id, $categoryChild->getParent()->id);
    }

    public function test_get_parent_returns_new_object_if_not_exists()
    {
        $category = factory(Category::class)->create();

        $this->assertEquals(new Category(), $category->getParent());
    }

    public function test_has_children_true()
    {
        $category = factory(Category::class)->create();
        $categoryChild = factory(Category::class)->create();
        $categoryChild->parent_id = $category->id;
        $categoryChild->save();

        $this->assertTrue($category->hasChildren());
    }

    public function test_has_children_false()
    {
        $category = factory(Category::class)->create();

        $this->assertFalse($category->hasChildren());
    }

    public function test_has_children_false_if_no_id()
    {
        $category = new Category();

        $this->assertFalse($category->hasChildren());
    }
}
