<?php

namespace App\Services\Dashboard;

use App\Models\Product;
use App\Repositories\Dashboard\ProductRepository;
use App\Utils\ImageManager;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

class ProductService
{
    protected $productRepository, $imageManager;

    public function __construct(ProductRepository $productRepository, ImageManager $imageManager)
    {
        $this->productRepository = $productRepository;
        $this->imageManager = $imageManager;
    }

    public function getProduct($id)
    {
        $product = $this->productRepository->getProduct($id);
        return $product ?? abort(404, 'Product Not Found');
    }

    public function getProductsForDataTable()
    {
        $products = $this->productRepository->getProductsForDataTable();
        return DataTables::of($products)
            ->addIndexColumn()
            ->addColumn('name', function ($row) {
                return $row->getTranslation('name', app()->getLocale());
            })
            ->addColumn('has_variants', function ($row) {
                return $row->hasVariantsTranslated();
            })
            ->addColumn('images', function ($row) {
                return view('dashboard.pages.products.datatables.images', compact('row'));
            })
            ->addColumn('status', function ($row) {
                return $row->getStatusTranslated();
            })
            ->addColumn('category', function ($row) {
                return $row->category->name;
            })
            ->addColumn('brand', function ($row) {
                return $row->brand->name;
            })
            ->addColumn('price', function ($row) {
                return $row->priceAttribute();
            })
            ->addColumn('quantity', function ($row) {
                return $row->quantityAttribute();
            })
            ->addColumn('actions', function ($row) {
                return view('dashboard.pages.products.datatables.actions', compact('row'));
            })
            ->rawColumns(['actions', 'images'])
            ->make(true);
    }

    public function createProduct($data)
    {
        return $this->productRepository->createProduct($data);
    }

    public function createProductVariant($data)
    {
        return $this->productRepository->createProductVariant($data);
    }

    public function createProductVariantAttribute($data)
    {
        return $this->productRepository->createProductVariantAttribute($data);
    }

    public function createProductWithDetails($productData, $productVariants, $images)
    {
        try {
            DB::beginTransaction();
            $product = $this->productRepository->createProduct($productData);
            foreach ($productVariants as $variant) {
                // create product variant
                $variant['product_id'] = $product->id;
                $createdVariant = $this->productRepository->createProductVariant($variant);

                // create product variant attribute
                foreach ($variant['attribute_value_ids'] as $attribute_value_id) {
                    $this->productRepository->createProductVariantAttribute([
                        'product_variant_id' => $createdVariant->id,
                        'attribute_value_id' => $attribute_value_id,
                    ]);
                }
            }

            // create product images
            $this->imageManager->uploadImages($images, $product, 'products');

            DB::commit();
            return true;
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public function changeStatus($request)
    {
        try {
            $product = $this->productRepository->getProduct($request->id);
            if (!$product) {
                return false;
            }

            $status = $product->status == 'active' ? 'inactive' : 'active';
            return $this->productRepository->changeStatus($product, $status);
        } catch (\Exception $e) {
            Log::error('Change Status Error: ' . $e->getMessage());
            return false;
        }
    }

    public function deleteProduct($request)
    {
        try {
            $product = $this->productRepository->getProduct($request->id);
            if (!$product) {
                return false;
            }
            return $this->productRepository->deleteProduct($product);
        } catch (\Exception $e) {
            Log::error('Delete Product Error: ' . $e->getMessage());
            return false;
        }
    }
}
