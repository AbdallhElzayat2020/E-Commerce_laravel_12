<?php

namespace App\Livewire\Dashboard;

use App\Services\Dashboard\ProductService;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\WithFileUploads;


class EditProduct extends Component
{
    use WithFileUploads;

    public $successMessage = '', $errorMessage = '', $currentStep = 1;

    // first step properties
    public $name_ar, $name_en, $desc_ar, $desc_en, $small_desc_ar, $small_desc_en, $sku, $available_for, $category_id, $brand_id;

    // second step properties
    public $has_variants, $has_discount, $manage_stock, $quantity, $price, $discount, $start_discount, $end_discount;

    public $variants, $quantities, $prices, $variantAttributes = [], $valueRowCount = 0;

    // third step properties
    public $images, $newImages;

    public $product;
    public $categories, $brands, $productId, $productAttributes = [];

    protected ProductService $productService;

    public function boot(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function mount($categories, $brands, $productId, $productAttributes)
    {
        $this->product = $this->productService->getProductWithEagerLoading($productId);
        $this->categories = $categories;
        $this->brands = $brands;
        $this->productAttributes = $productAttributes;
        $this->images = $this->product->images;

        //        // first step properties
        $this->name_ar = $this->product->getTranslation('name', 'ar');
        $this->name_en = $this->product->getTranslation('name', 'en');
        $this->desc_ar = $this->product->getTranslation('desc', 'ar');
        $this->desc_en = $this->product->getTranslation('desc', 'en');
        $this->small_desc_ar = $this->product->getTranslation('small_desc', 'ar');
        $this->small_desc_en = $this->product->getTranslation('small_desc', 'en');
        $this->sku = $this->product->sku;
        $this->available_for = $this->product->available_for;
        $this->category_id = $this->product->category_id;
        $this->brand_id = $this->product->brand_id;

        // second step properties
        $this->has_variants = $this->product->has_variants;
        $this->manage_stock = $this->product->manage_stock;
        $this->quantity = $this->product->quantity;
        $this->has_discount = $this->product->has_discount;
        $this->price = $this->product->price;
        $this->discount = $this->product->discount;
        $this->start_discount = $this->product->start_discount;
        $this->end_discount = $this->product->end_discount;

        if ($this->has_variants == 1) {
            $this->variants = $this->product->variants;
            $this->valueRowCount = count($this->variants);
            foreach ($this->variants as $key => $variant) {
                $this->prices[$key] = $variant->price;
                $this->quantities[$key] = $variant->stock;

                foreach ($variant->variantAttribute as $variantAttribute) {
                    $this->variantAttributes[$key][$variantAttribute->attributeValue->attribute_id] = $variantAttribute->attribute_value_id;
                }
            }
        }
    }

    public function back($step)
    {
        $this->currentStep = $step;
    }

    public function firstStepSubmit()
    {
        $this->validate([
            'name_ar' => ['required', 'string', 'max:80'],
            'name_en' => ['required', 'string', 'max:80'],
            'desc_ar' => ['required', 'string', 'max:1000'],
            'desc_en' => ['required', 'string', 'max:1000'],
            'small_desc_ar' => ['required', 'string', 'max:150'],
            'small_desc_en' => ['required', 'string', 'max:150'],
            'sku' => ['required', 'string', 'max:30'],
            'category_id' => ['required', 'exists:categories,id'],
            'brand_id' => ['required', 'exists:brands,id'],
            'available_for' => ['required', 'date'],
        ]);
        $this->currentStep = 2;
    }

    public function secondStepSubmit()
    {
        $data = [
            'has_variants' => ['required', 'in:0,1'],
            'manage_stock' => ['required', 'in:0,1'],
            'has_discount' => ['required', 'in:0,1'],
        ];
        if ($this->has_variants == 0) {
            $data['price'] = ['required', 'numeric', 'min:1', 'max:1000000'];
        }
        if ($this->manage_stock == 1 && $this->has_variants == 0) {
            $data['quantity'] = ['required', 'numeric', 'min:1', 'max:1000000'];
        }
        if ($this->has_discount == 1) {
            $data['discount'] = ['required', 'numeric', 'min:1', 'max:100'];
            $data['start_discount'] = ['nullable', 'date', 'before:end_discount'];
            $data['end_discount'] = ['nullable', 'date', 'after:start_discount'];
        }
        if ($this->has_variants == 1) {
            $data['prices'] = ['required', 'array', 'min:1'];
            $data['prices.*'] = ['required', 'numeric', 'min:1', 'max:1000000'];
            $data['quantities'] = ['required', 'array', 'min:1'];
            $data['quantities.*'] = ['required', 'integer', 'min:0'];
            $data['variantAttributes'] = ['required', 'array', 'min:1'];
            $data['variantAttributes.*'] = ['required', 'array'];
            $data['variantAttributes.*.*'] = ['required', 'integer', 'exists:attribute_values,id'];
        }

        try {
            $this->validate($data);
            $this->errorMessage = '';
            $this->currentStep = 3;
        } catch (\Illuminate\Validation\ValidationException $e) {
            $firstError = collect($e->validator->errors()->all())->first();
            $this->errorMessage = $firstError ?: 'Validation error';
        }
    }

    public function addNewVariant()
    {
        $this->prices[] = null;
        $this->quantities[] = null;
        $this->variantAttributes[] = [];
        $this->valueRowCount = count($this->prices); // Keep count synchronized
    }

    public function removeVariant()
    {
        if ($this->valueRowCount > 1) {
            $this->valueRowCount--;
            array_pop($this->prices);
            array_pop($this->quantities);
            array_pop($this->variantAttributes);
        }
    }

    public function deleteImage($imageId, $key, $file_name)
    {
        $this->productService->deleteProductImage($imageId, $file_name);
        unset($this->images[$key]);
    }

    public function deleteNewImage($key)
    {
        unset($this->newImages[$key]);
    }

    public function submitForm()
    {
        //
        $productData = [
            'name' => [
                'ar' => $this->name_ar,
                'en' => $this->name_en,
            ],

            'desc' => [
                'ar' => $this->desc_ar,
                'en' => $this->desc_en,
            ],

            'small_desc' => [
                'ar' => $this->small_desc_ar,
                'en' => $this->small_desc_en,
            ],

            'category_id' => $this->category_id,
            'brand_id' => $this->brand_id,
            'sku' => $this->sku,
            'available_for' => $this->available_for,
            'has_variants' => $this->has_variants,
            'manage_stock' => $this->manage_stock ?? 0,
            'price' => $this->has_variants == 1 ? null : $this->price,
            'quantity' => ($this->has_variants == 0 && $this->manage_stock == 1) ? $this->quantity : null,
            'has_discount' => $this->has_discount,
            'discount' => $this->has_discount == 1 ? $this->discount : null,
            'start_discount' => $this->has_discount == 1 ? $this->start_discount : null,
            'end_discount' => $this->has_discount == 1 ? $this->end_discount : null,
        ];

        // store Variants
        $productVariants = [];
        if ($this->has_variants) {
            foreach ($this->prices as $index => $price) {
                $productVariants[] = [
                    'product_id' => $this->product->id,
                    'price' => $price,
                    'stock' => $this->quantities[$index] ?? 0,
                    'attribute_value_ids' => $this->variantAttributes[$index] ?? [],
                ];
            }
        }

        $productUpdated = $this->productService->UpdateProductWithDetails($this->product, $productData, $productVariants, $this->newImages);
        if (!$productUpdated) {
            $this->errorMessage = __('dashboard.error_msg');
            $this->currentStep = 1;
        }

        Session::flash('success', __('dashboard.success_msg'));;
        return redirect()->route('dashboard.products.index');
    }

    public function render()
    {
        return view('livewire.dashboard.edit-product');
    }
}
