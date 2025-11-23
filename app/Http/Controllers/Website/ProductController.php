<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Services\Website\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;

    }

    public function showProductDetails(string $slug)
    {
        $product = $this->productService->showProductDetails($slug);
        if (!$product) {
            abort(404);
        }
        return view('frontend.pages.show-product', compact('product'));
    }

    public function showProductsByType(string $type)
    {
        if ($type == 'new-arrival-products') {
            $products = $this->productService->newArrivalProducts();

        } elseif ($type == 'flash-time-products') {
            $products = $this->productService->getFlashProductsWithTimer();

        } elseif ($type == 'flash-products') {
            $products = $this->productService->getFlashProducts();

        } else {
            abort(404);
        }

        return view('frontend.pages.products', [
            'products' => $products,
            'flash_time_products' => $type == 'flash-time-products' ? true : false,
        ]);
    }
}
