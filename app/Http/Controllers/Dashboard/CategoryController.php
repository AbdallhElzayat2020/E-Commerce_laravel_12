<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{

    public function index()
    {
        return view('dashboard.pages.categories.index');
    }

    public function getAllCategories()
    {
        $categories = Category::query();
        return DataTables::of($categories)
            ->addColumn('name', function ($category) {
                $locale = app()->getLocale();
                return $category->getTranslation('name', $locale) ?: $category->getTranslation('name', 'en');
            })
            ->addColumn('created_at', function ($category) {
                // returned as string by accessor on Category model
                return $category->created_at;
            })
            ->addColumn('actions', function ($category) {
                return
                    '<a href="' . route('dashboard.categories.destroy', $category->id) . '" class="btn btn-sm btn-danger mx-1">Delete</a>' .
                    '<a href="' . route('dashboard.categories.edit', $category->id) . '" class="btn btn-sm btn-primary mx-1">Edit</a>';
            })
            ->addColumn('status', function ($category) {
                return $category->status === 'active' ? '<span class="badge badge-success">Active</span>' : '<span class="badge badge-danger">Inactive</span>';
            })
            ->rawColumns(['status', 'actions'])
            ->make(true);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }


    public function show(string $id)
    {
        //
    }


    public function edit(string $id)
    {
        //
    }


    public function update(Request $request, string $id)
    {
        //
    }


    public function destroy(string $id)
    {
        //
    }

    public function updateStatus()
    {
        //
    }
}
