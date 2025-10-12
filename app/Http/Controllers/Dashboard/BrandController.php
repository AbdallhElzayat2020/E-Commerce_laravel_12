<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Store\StoreBrandRequest;
use App\Http\Requests\Dashboard\Update\UpdateBrandRequest;
use App\Services\Dashboard\BrandService;
use Illuminate\Http\Request;

class BrandController extends Controller
{

    public BrandService $brandService;

    public function __construct(BrandService $brandService)
    {
        $this->brandService = $brandService;
    }


    public function getAll()
    {
        return $this->brandService->getBrandsForDataTables();
    }

    public function index()
    {
        return view('dashboard.pages.brands.index');
    }

    public function store(StoreBrandRequest $request)
    {
        $data = $request->validated();
        $brand = $this->brandService->createBrand($data);
        if (!$brand) {
            return redirect()->back()->with('error', __('dashboard.error_msg'));
        }
        return redirect()->route('dashboard.brands.index')->with('success', __('dashboard.success_msg'));
    }

    public function create()
    {
        //
    }

    public function show(string $id)
    {
        //
    }


    public function edit(string $id)
    {
        $brand = $this->brandService->getBrand($id);
        return view('dashboard.pages.brands.edit', compact('brand'));
    }


    public function update(UpdateBrandRequest $request, string $id)
    {
        $data = $request->validated();

        $brand = $this->brandService->updateBrand($id, $data);

        if (!$brand) {
            return redirect()->back()->with('error', __('dashboard.error_msg'));
        }
        return redirect()->route('dashboard.brands.index')->with('success', __('dashboard.success_msg'));
    }


    public function destroy(string $id)
    {
        $brand = $this->brandService->deleteBrand($id);
        if (!$brand) {
            return redirect()->back()->with('error', __('dashboard.error_msg'));
        }
        return redirect()->route('dashboard.brands.index')->with('success', __('dashboard.success_msg'));
    }

    public function updateStatus()
    {
    }

    public function getAllBrands()
    {
    }
}
