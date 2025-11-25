<?php

namespace App\Services\Website;

use App\Models\Product;

class ProductService
{


    public function getProductBySlug($slug)
    {
        return Product::with([
            'images',
            'brand',
            'category',
            'productPreviews',
            'variants.VariantAttribute.attributeValue.attribute',
        ])
            ->select([
                'id',
                'name',
                'desc',
                'small_desc',
                'slug',
                'price',
                'has_variants',
                'quantity',
                'manage_stock',
                'has_discount',
                'discount',
                'category_id',
                'brand_id'
            ])
            ->active()
            ->whereSlug($slug)
            ->first();
    }

    public function getRelatedProductBySlug($slug, $limit = null)
    {

        //        $product = Product::whereSlug($slug)->first();
        //        $product->category->products()->where('id', '!=', $product->id);

        $categoryId = Product::whereSlug($slug)->first()->category_id;

        $products = Product::with(['images'])
            ->select('id', 'name', 'slug', 'price', 'has_variants', 'has_discount', 'brand_id', 'category_id')
            ->where('slug', '!=', $slug)
            ->active()
            ->whereCategoryId($categoryId)
            ->latest();

        if ($limit) {
            return $products->paginate($limit);
        }
        return $products->paginate(20);
    }

    public function newArrivalProducts($limit = null)
    {

        $products = Product::query()
            ->with(['images', 'brand', 'category'])
            ->active()
            ->latest()
            ->select('id', 'name', 'slug', 'price', 'has_variants', 'has_discount', 'brand_id', 'category_id');

        if ($limit) {
            return $products->paginate($limit);
        }
        return $products->paginate(20);
    }

    public function getFlashProducts($limit = null)
    {
        $products = Product::query()
            ->with(['images', 'brand', 'category'])
            ->active()
            ->where('has_discount', 1)
            ->latest()
            ->select('id', 'name', 'slug', 'price', 'has_variants', 'has_discount', 'brand_id', 'category_id');

        if ($limit) {
            return $products->paginate($limit);
        }
        return $products->paginate(20);
    }

    public function getFlashProductsWithTimer($limit = null)
    {
        $products = Product::query()
            ->with(['images', 'brand', 'category'])
            ->active()
            ->where('available_for', date('Y-m-d'))
            ->whereNotNull('available_for')
            ->where('has_discount', 1)
            ->latest()
            ->select('id', 'name', 'slug', 'price', 'has_variants', 'has_discount', 'brand_id', 'category_id');

        if ($limit) {
            return $products->paginate($limit);
        }
        return $products->paginate(20);
    }
}
