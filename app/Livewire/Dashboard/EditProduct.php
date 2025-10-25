<?php

namespace App\Livewire\Dashboard;

use App\Models\Product;
use App\Services\Dashboard\ProductService;
use Livewire\Component;

class EditProduct extends Component
{
    public $product;
    public $productId, $categories, $brands, $productAttributes = [];

    public ProductService $productService;

    public function boot(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function mount($productId, $categories, $brands, $productAttributes)
    {
        $this->product = $this->productService->getProductWithEagerLoading($productId);
        $this->categories = $categories;
        $this->brands = $brands;
        $this->productAttributes = $productAttributes;
    }

    public function render()
    {
        return view('livewire.dashboard.edit-product');
    }
}
