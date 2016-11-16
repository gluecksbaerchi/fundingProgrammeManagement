<?php
/**
 * Created by PhpStorm.
 * User: Carolin
 * Date: 12.11.2016
 * Time: 18:53
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = [
        'name', 'parent_id'
    ];

    public function getParent()
    {
        return $this->parent_id ? Category::find($this->parent_id) : new Category();
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function hasChildren()
    {
        if ($this->id == null) {
            return false;
        }
        $count = Category::where('parent_id', '=', $this->id)->count();
        return $count > 0;
    }
}
