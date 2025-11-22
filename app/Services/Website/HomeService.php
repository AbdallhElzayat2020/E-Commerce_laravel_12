<?php

namespace App\Services\Website;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;

class HomeService
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }


    public function getSliders()
    {
        return Slider::latest()->get();
    }

    public function getCategories($limit = null)
    {
        if ($limit == null) {
            return Category::active()->get();
        }
        return Category::active()->limit($limit)->get();
    }

    public function getBrands($limit = null)
    {
        if ($limit == null) {
            return Brand::active()->get();
        }
        return Brand::active()->limit($limit)->get();
    }

    public function getProductsByBrand($slug)
    {
        $brand = Brand::whereSlug($slug)->first();

        return $brand->products()->with(['images', 'brand', 'category'])
            ->active()
            ->latest()
            ->select('id', 'name', 'slug', 'price', 'has_variants', 'has_discount', 'brand_id', 'category_id')
            ->paginate(16);
    }

    public function getProductsByCategory($slug)
    {
        $category = Category::whereSlug($slug)->first();
        return $category->products()->with(['images', 'brand', 'category'])
            ->active()
            ->latest()
            ->select('id', 'name', 'slug', 'price', 'has_variants', 'has_discount', 'brand_id', 'category_id')
            ->paginate(16);
    }

    public function newArrivalProducts($limit = null)
    {
        return $this->productService->newArrivalProducts($limit);
    }

    public function getFlashProducts($limit = null)
    {
        return $this->productService->getFlashProducts($limit);
    }

    public function getFlashProductsWithTimer($limit)
    {
        return $this->productService->getFlashProductsWithTimer($limit);
    }
}
