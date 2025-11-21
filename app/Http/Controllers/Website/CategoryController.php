<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Services\Website\HomeService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $homeService;

    public function __construct(HomeService $homeService)
    {
        $this->homeService = $homeService;
    }

    public function showCategoryPage()
    {
        $categories = $this->homeService->getCategories();
        return view('frontend.pages.categories', compact('categories'));
    }
}
