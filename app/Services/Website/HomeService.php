<?php

namespace App\Services\Website;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Slider;

class HomeService
{
    public function getSliders()
    {
        return Slider::latest()->get();
    }

    public function getCategories($limit = null)
    {
        if ($limit == null) {
            return Category::active()->get();
        }
        return Category::active()->limit($limit)->get();
    }

    public function getBrands($limit = null)
    {
        if ($limit == null) {
            return Brand::active()->get();
        }
        return Brand::active()->limit($limit)->get();
    }
}
