<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Slider;
use App\Services\Website\CategoryService;
use App\Services\Website\HomeService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $homeService;

    public function __construct(HomeService $homeService)
    {
        $this->homeService = $homeService;
    }

    public function index()
    {
        $sliders = $this->homeService->getSliders();
        $some_categories = $this->homeService->getCategories(12);
        $some_brands = $this->homeService->getBrands(12);

        $newArrivalProducts = $this->homeService->newArrivalProducts(8);
        $flashProducts = $this->homeService->getFlashProducts(8);
        $flashProductsWithTimer = $this->homeService->getFlashProductsWithTimer(8);


        return view('frontend.pages.home', [
            'sliders' => $sliders,
            'categories' => $some_categories,
            'brands' => $some_brands,

            'newArrivalProducts' => $newArrivalProducts,
            'flashProducts' => $flashProducts,
            'flashProductsWithTimer' => $flashProductsWithTimer,
        ]);
    }
}
