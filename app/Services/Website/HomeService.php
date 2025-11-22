<?php

namespace App\Services\Website;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;

class HomeService
{
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

//        return Product::with(['images', 'brand', 'category'])
//            ->active()
//            ->latest()
//            ->select('id', 'name', 'slug', 'price', 'has_variants', 'has_discount', 'brand_id', 'category_id')
//            ->where('brand_id', $brand_id)
//            ->paginate(12);
    }

    public function getProductsByCategory($slug)
    {
        $brand = Brand::whereSlug($slug)->first();

        return $brand->products()->with(['images', 'brand', 'category'])
            ->active()
            ->latest()
            ->select('id', 'name', 'slug', 'price', 'has_variants', 'has_discount', 'brand_id', 'category_id')
            ->paginate(16);

//        return Product::with(['images', 'brand', 'category'])
//            ->active()
//            ->latest()
//            ->select('id', 'name', 'slug', 'price', 'has_variants', 'has_discount', 'brand_id', 'category_id')
//            ->where('brand_id', $brand_id)
//            ->paginate(12);
    }
}
