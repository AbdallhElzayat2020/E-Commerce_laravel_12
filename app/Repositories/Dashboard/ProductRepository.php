<?php

namespace App\Repositories\Dashboard;

use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\VariantAttribute;

class ProductRepository
{
    public function getProductsForDataTable()
    {
        return Product::with(['category', 'brand', 'images', 'variants']);
    }

    public function getProductWithEagerLoading($id)
    {
        return Product::with(['category', 'brand', 'images', 'variants.variantAttribute'])->find($id);
    }

    public function getProduct($id)
    {
        return Product::find($id);
    }

    public function createProduct($data)
    {
        return Product::create($data);
    }

    public function createProductVariant($data)
    {
        return ProductVariant::create($data);
    }

    public function createProductVariantAttribute($data)
    {
        return VariantAttribute::create($data);
    }

    public function changeStatus($product, $status)
    {
        $product->status = $status;
        return $product->save();
    }

    public function deleteProduct($product)
    {
        if (!$product) {
            return false;
        }
        return $product->delete();
    }
}
