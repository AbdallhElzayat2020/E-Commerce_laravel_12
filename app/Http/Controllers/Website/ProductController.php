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
}
