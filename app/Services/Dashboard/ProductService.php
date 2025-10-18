<?php

namespace App\Services\Dashboard;

use App\Repositories\Dashboard\ProductRepository;

class ProductService
{
    protected ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }
}
