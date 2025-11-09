<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Services\Dashboard\CategoryService;

class CategoryController extends Controller
{

    public CategoryService $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        return view('dashboard.pages.categories.index');
    }

    public function getAllCategories()
    {
        return $this->categoryService->getCategoriesForDataTable();
    }

    public function getCategoryById($id)
    {
        return $this->categoryService->getCategoryById($id);
    }

    public function create()
    {
        $categories = $this->categoryService->getParentCategories();
        return view('dashboard.pages.categories.create', compact('categories'));
    }

    public function store(StoreCategoryRequest $request)
    {
        $data = $request->only(['name', 'parent_id', 'status', 'icon']);
        if (!$this->categoryService->store($data)) {
            return redirect()->back()->with('error', __('dashboard.error_msg'));
        }
        return redirect()->route('dashboard.categories.index')->with('success', __('dashboard.success_msg'));
    }

    public function edit(string $id)
    {
        $category = $this->categoryService->getCategoryById($id);

        if (!$category) {
            return redirect()->back()->with('error', __('dashboard.error_msg'));
        }
        $categories = $this->categoryService->getCategoriesExceptChildren($id);
        return view('dashboard.pages.categories.edit', compact('category', 'categories'));
    }


    public function update(UpdateCategoryRequest $request)
    {
        $data = $request->only(['name', 'parent_id', 'status', 'id', 'icon']);

        $data['status'] = $request->status == 'active' ? 'active' : 'inactive';

        if (!$this->categoryService->update($data)) {
            return redirect()->back()->with('error', __('dashboard.error_msg'));
        }
        return redirect()->route('dashboard.categories.index')->with('success', __('dashboard.success_msg'));
    }


    public function destroy(string $id)
    {
        $category = $this->categoryService->delete($id);

        if (!$category) {
            return redirect()->back()->with('error', __('dashboard.error_msg'));
        }
        return redirect()->route('dashboard.categories.index')->with('success', __('dashboard.success_msg'));
    }

    public function updateStatus()
    {
        //
    }
}
