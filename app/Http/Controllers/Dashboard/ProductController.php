<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Services\Dashboard\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {

        return view('dashboard.pages.products.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $brands = Brand::all();
        $categories = Category::all();
        return view('dashboard.pages.products.create', compact('brands', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
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
}
