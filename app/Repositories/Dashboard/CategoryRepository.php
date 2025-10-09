<?php

namespace App\Repositories\Dashboard;

use App\Models\Category;

class CategoryRepository
{

    public function getCategories()
    {
        return Category::query();
    }

    public function getById($id)
    {
        return Category::find($id);
    }

    public function store($data)
    {
        return Category::create($data);
    }

    public function update($category, $data)
    {
        return $category->update($data);
    }

    public function delete($category)
    {
        return $category->delete();
    }


    public function getCategoriesExceptChildren($id)
    {
        return Category::where('id', '!=', $id)
            ->whereNull('parent_id')
            ->get();
    }

    public function getParentCategories()
    {
        return Category::whereNull('parent_id')
            ->get();
    }
}
