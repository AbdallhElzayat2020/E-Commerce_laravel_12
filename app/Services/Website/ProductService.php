<?php

namespace App\Services\Website;

use App\Models\Product;

class ProductService
{


    public function showProductDetails($slug)
    {
        return Product::with(['images', 'brand', 'category'])
            ->active()
            ->whereSlug($slug)
            ->first();
    }

    public function newArrivalProducts($limit = null)
    {

        return Product::with(['images', 'brand', 'category'])
            ->active()
            ->latest()
            ->select('id', 'name', 'slug', 'price', 'has_variants', 'has_discount', 'brand_id', 'category_id')
            ->paginate($limit);
    }

    public function getFlashProducts($limit = null)
    {
        return Product::with(['images', 'brand', 'category'])
            ->active()
            ->where('has_discount', 1)
            ->latest()
            ->select('id', 'name', 'slug', 'price', 'has_variants', 'has_discount', 'brand_id', 'category_id')
            ->paginate($limit);
    }

    public function getFlashProductsWithTimer($limit = 8)
    {
        return Product::with(['images', 'brand', 'category'])
            ->active()
            ->where('available_for', date('Y-m-d'))
            ->whereNotNull('available_for')
            ->where('has_discount', 1)
            ->latest()
            ->select('id', 'name', 'slug', 'price', 'has_variants', 'has_discount', 'brand_id', 'category_id')
            ->paginate($limit);
    }
}
