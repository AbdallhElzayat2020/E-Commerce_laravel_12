<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Services\Website\HomeService;
use Illuminate\Http\Request;

class BrandController extends Controller
{

    protected $homeService;

    public function __construct(HomeService $homeService)
    {
        $this->homeService = $homeService;
    }

    public function showBrandPage()
    {
        $brands = $this->homeService->getBrands();
        return view('frontend.pages.brands', compact('brands'));
    }


    public function getProductsByBrand(string $slug)
    {
        $products = $this->homeService->getProductsByBrand($slug);
        return view('frontend.pages.products', compact('products'));
    }
}
