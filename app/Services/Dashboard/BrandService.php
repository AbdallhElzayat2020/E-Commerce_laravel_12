<?php

namespace App\Services\Dashboard;

use App\Repositories\Dashboard\BrandRepository;
use App\Utils\ImageManager;
use Illuminate\Support\Facades\Cache;
use Yajra\DataTables\Facades\DataTables;

class BrandService
{

    public $brandRepository, $imageManager;

    public function __construct(BrandRepository $brandRepository, ImageManager $imageManager)
    {
        $this->brandRepository = $brandRepository;
        $this->imageManager = $imageManager;
    }

    public function getAllBrands()
    {
        return $this->brandRepository->getBrands();
    }

    public function getBrandsForDataTables()
    {
        $brands = $this->getAllBrands();

        return DataTables::of($brands)
            ->addIndexColumn()
            ->addColumn('status', function ($brand) {
                return view('dashboard.pages.brands.datatables.status', compact('brand'))->render();
            })
            ->addColumn('name', function ($brand) {
                return $brand->getTranslation('name', app()->getLocale());
            })
            ->addColumn('logo', function ($brand) {
                return view('dashboard.pages.brands.datatables.logo', compact('brand'))->render();
            })
            ->addColumn('products_count', function ($brand) {
                return $brand->products_count == 0 ? __('dashboard.not_found') : $brand->products_count;
            })
            ->addColumn('actions', function ($brand) {
                return view('dashboard.pages.brands.datatables.actions', compact('brand'))->render();
            })
            ->rawColumns(['status', 'actions', 'logo'])
            ->make(true);
    }

    public function getBrand($id)
    {
        $brand = $this->brandRepository->getBrand($id);
        if (!$brand) {
            abort(404);
        }
        return $brand;
    }

    public function createBrand($data)
    {
        if (array_key_exists('logo', $data) && $data['logo'] != null) {

            $file_name = $this->imageManager->uploadSingleFile('/', $data['logo'], 'brands');
            $data['logo'] = $file_name;
        } else {
            unset($data['logo']);
        }
        $brand = $this->brandRepository->createBrand($data);
        self::brandCache();
        return $brand;
    }

    public function updateBrand($id, $data)
    {
        $brand = $this->getBrand($id);

        if (!$brand) {
            abort(404);
        }

        if (array_key_exists('logo', $data) && $data['logo'] != null) {
            if (!empty($brand->logo)) {
                $this->imageManager->deleteImageLocal($brand->logo);
            }

            $file_name = $this->imageManager->uploadSingleFile('/', $data['logo'], 'brands');
            $data['logo'] = $file_name;
        } else {
            unset($data['logo']);
        }
        $brand = $this->brandRepository->updateBrand($brand, $data);
        self::brandCache();
        return $brand;
    }

    public function deleteBrand($id)
    {
        $brand = $this->getBrand($id);
        if ($brand->logo != null) {
            $this->imageManager->deleteImageLocal($brand->logo);
        }

        $brand = $this->brandRepository->deleteBrand($brand);
        self::brandCache();
        return $brand;
    }

    /*  Clear Cache */
    public function brandCache()
    {
        Cache::forget('brands_count');
    }
}
