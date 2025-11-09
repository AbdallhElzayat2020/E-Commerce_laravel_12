<?php

namespace App\Services\Dashboard;

use App\Repositories\Dashboard\CategoryRepository;
use App\Utils\ImageManager;
use Yajra\DataTables\Facades\DataTables;

class CategoryService

{

    protected $categoryRepository, $imageManager;

    public function __construct(CategoryRepository $categoryRepository, ImageManager $imageManager)
    {
        $this->categoryRepository = $categoryRepository;
        $this->imageManager = $imageManager;
    }

    public function getAllCategories()
    {
        return $this->categoryRepository->getCategories();
    }

    public function getCategoriesForDataTable()
    {
        $categories = $this->getAllCategories();

        return DataTables::of($categories)
            ->addIndexColumn()
            ->addColumn('name', function ($category) {
                $locale = app()->getLocale();
                return $category->getTranslation('name', $locale) ?: $category->getTranslation('name', 'en');
            })
            ->addColumn('products_count', function ($category) {
                return $category->products()->count() == 0 ? __('dashboard.not_found') : $category->products()->count();
            })
            ->addColumn('icon', function ($category) {
                return view('dashboard.pages.categories.datatables.icon', compact('category'))->render();
            })
            ->addColumn('created_at', function ($category) {
                // returned by accessor on a Category model
                return $category->created_at;
            })
            ->addColumn('actions', function ($category) {
                return view('dashboard.pages.categories.datatables.actions', compact('category'))->render();
            })
            ->addColumn('status', function ($category) {
                return view('dashboard.pages.categories.datatables.status', compact('category'))->render();
            })
            ->rawColumns(['status', 'actions', 'icon'])
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
        if (array_key_exists('icon', $data) && $data['icon'] != null) {
            $file_name = $this->imageManager->uploadSingleFile('/', $data['icon'], 'categories');
            $data['icon'] = $file_name;
        }
        return $this->categoryRepository->store($data);
    }

    public function update($data)
    {
        $category = $this->categoryRepository->getById($data['id']);

        if (!$category) {
            return false;
        }

        if (array_key_exists('icon', $data) && $data['icon'] != null) {

            $this->imageManager->deleteImageLocal($category->icon);

            $file_name = $this->imageManager->uploadSingleFile('/', $data['icon'], 'categories');
            $data['icon'] = $file_name;
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
