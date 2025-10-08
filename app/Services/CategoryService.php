<?php

namespace App\Services;

use App\Repositories\CategoryRepository;
use Yajra\DataTables\Facades\DataTables;

class CategoryService

{

    protected CategoryRepository $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getCategoriesForDataTable()
    {
        $categories = $this->categoryRepository->getCategories();

        return DataTables::of($categories)
            ->addIndexColumn()
            ->addColumn('name', function ($category) {
                $locale = app()->getLocale();
                return $category->getTranslation('name', $locale) ?: $category->getTranslation('name', 'en');
            })
            ->addColumn('created_at', function ($category) {
                // returned by accessor on a Category model
                return $category->created_at;
            })
            ->addColumn('actions', function ($category) {
                return view('dashboard.pages.categories.actions', compact('category'))->render();
            })
            ->addColumn('status', function ($category) {
                return $category->status === 'active' ? '<span class="badge badge-success">Active</span>' : '<span class="badge badge-danger">Inactive</span>';
            })
            ->rawColumns(['status', 'actions'])
            ->make(true);
    }

    public function getCategoryById($id)
    {
        return $this->categoryRepository->getById($id);
    }

    //    public function deleteCategory($id)
    //    {
    //        $category = $this->getCategoryById($id);
    //        if (!$category){
    //
    //        }
    //    }

    public function store($data)
    {
        return $this->categoryRepository->store($data);
    }

    public function update($data)
    {
        $category = $this->categoryRepository->getById($data['id']);
        if (!$category) {
            return false;
        }
        return $this->categoryRepository->update($category, $data);
    }

    public function delete($id)
    {
        $category = $this->categoryRepository->getById($id);
        if (!$category) {
            return false;
        }
        return $this->categoryRepository->delete($category);
    }

    public function getCategoriesExceptChildren($id)
    {
        return $this->categoryRepository->getCategoriesExceptChildren($id);
    }

    public function getParentCategories()
    {
        return $this->categoryRepository->getParentCategories();
    }
}
