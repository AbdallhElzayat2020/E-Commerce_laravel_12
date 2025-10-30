<?php

namespace App\Repositories\Dashboard;

use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductVariant;
use App\Models\VariantAttribute;

class ProductRepository
{
    public function getProductsForDataTable()
    {
        return Product::with(['category', 'brand', 'images', 'variants'])->latest()->get();
    }

    public function getProductWithEagerLoading($id)
    {
        return Product::with('variants.VariantAttribute')->find($id);
    }

    public function getProduct($id)
    {
        return Product::find($id);
    }

    public function createProduct($data)
    {
        return Product::create($data);
    }

    public function updateProduct($product, $data)
    {
        return $product->update($data);
    }

    public function createProductVariant($data)
    {
        return ProductVariant::create($data);
    }

    public function createProductVariantAttribute($data)
    {
        return VariantAttribute::create($data);
    }

    public function deleteProductVariants($productId)
    {
        return ProductVariant::where('product_id', $productId)->delete();
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

    public function deleteProductImage($imageId)
    {
        return ProductImage::find($imageId)->delete();
    }
}
