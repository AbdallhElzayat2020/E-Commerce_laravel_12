<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository
{

    public function getCategories()
    {
        return Category::select('id', 'name', 'status')->paginate(9);
    }

    public function createCategory($data)
    {
        Category::create($data);
    }

    public function getCategoryById($id)
    {
        return Category::find($id);
    }

    public function updateCategory($id, $data)
    {
        $category = $this->getCategoryById($id);
        if (!$category) {
            return false;
        }
        $category->update($data);
        return true;
    }

    public function deleteCategory($id)
    {
        $category = $this->getCategoryById($id);
        if (!$category) {
            return false;
        }
        $category->delete();
        return true;
    }
}
