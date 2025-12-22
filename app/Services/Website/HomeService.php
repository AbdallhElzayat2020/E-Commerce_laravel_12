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
        return cache()->remember('sliders', 3600, function () {
            return Slider::latest()->get();
        });
    }

    public function getCategories($limit = null)
    {
        $cacheKey = $limit ? "categories_limit_{$limit}" : 'categories_all';

        return cache()->remember($cacheKey, 3600, function () use ($limit) {
            $query = Category::active();
            if ($limit) {
                return $query->limit($limit)->get();
            }
            return $query->get();
        });
    }

    public function getBrands($limit = null)
    {
        $cacheKey = $limit ? "brands_limit_{$limit}" : 'brands_all';

        return cache()->remember($cacheKey, 3600, function () use ($limit) {
            $query = Brand::active();
            if ($limit) {
                return $query->limit($limit)->get();
            }
            return $query->get();
        });
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

    public function getHomePageProducts($limit = null): array
    {
        return [
            'newArrivalProducts' => $this->productService->newArrivalProducts($limit),
            'flashProducts' => $this->productService->getFlashProducts($limit),
            'flashProductsWithTimer' => $this->productService->getFlashProductsWithTimer($limit),
        ];
    }
}
