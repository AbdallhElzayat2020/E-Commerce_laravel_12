<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\ProductVariant;
use App\Http\Controllers\Controller;
use App\Services\Dashboard\BrandService;
use App\Services\Dashboard\ProductService;
use App\Services\Dashboard\CategoryService;
use App\Services\Dashboard\AttributeService;

class ProductController extends Controller
{

    protected $productService, $categoryService, $brandService, $attributeService;

    public function __construct(ProductService   $productService, CategoryService  $categoryService, BrandService     $brandService, AttributeService $attributeService
    )
    {
        $this->productService = $productService;
        $this->categoryService = $categoryService;
        $this->brandService = $brandService;
        $this->attributeService = $attributeService;
    }

    public function index()
    {
        return view('dashboard.pages.products.index');
    }


    public function create()
    {
        $brands = Brand::all();
        $categories = Category::all();
        return view('dashboard.pages.products.create', compact('brands', 'categories'));
    }


    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        $product = $this->productService->getProduct($id);
        return view('dashboard.pages.products.show', compact('product'));
    }


    public function edit(string $id)
    {
        $productId    = $id;
        $categories   = $this->categoryService->getAllCategories();
        $brands       = $this->brandService->getAllBrands();
        $attributes   = $this->attributeService->getAttributes();

        return view('dashboard.pages.products.edit', compact('productId', 'categories', 'brands', 'attributes'));
    }


    public function update(Request $request, string $id)
    {
        //
    }


    public function destroy(Request $request)
    {
        if ($this->productService->deleteProduct($request)) {
            return response()->json([
                'status' => 'success',
                'message' => __('dashboard.success_msg'),
            ], 200);
        }
        return response()->json([
            'status' => 'error',
            'message' => __('dashboard.error_msg'),
        ], 500);
    }

    public function getAll()
    {
        return $this->productService->getProductsForDataTable();
    }

    public function updateStatus(Request $request)
    {
        if ($this->productService->changeStatus($request)) {
            return response()->json([
                'status' => 'success',
                'message' => __('dashboard.success_msg'),
            ], 200);
        }
        return response()->json([
            'status' => 'error',
            'message' => __('dashboard.error_msg'),
        ], 500);
    }

    public function deleteVariant($variant_id)
    {
        $variant = ProductVariant::findOrFail($variant_id);
        $product = $variant->product;
        if ($product->variants()->count() == 1) {
            return redirect()->back()->with('error', 'you can not delete the last variant');
        }
        $variant->delete();
        return redirect()->back()->with('success', 'variant deleted successfully');
    }
}
