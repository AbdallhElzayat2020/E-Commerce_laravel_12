<?php

namespace App\Repositories\Dashboard;

use App\Models\Brand;

class BrandRepository
{
    public function getBrands()
    {
        return Brand::withCount('products')->latest()->get();
    }

    public function getBrand($id)
    {
        return Brand::find($id);
    }

    public function createBrand($data)
    {
        return Brand::create($data);
    }

    public function updateBrand($brand, $data)
    {

        return $brand->update($data);
    }


    public function deleteBrand($brand)
    {
        return $brand->delete();
    }
}
