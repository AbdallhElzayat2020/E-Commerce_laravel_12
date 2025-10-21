<?php

namespace App\Livewire\Dashboard;

use App\Models\Product;
use App\Utils\ImageManager;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateProduct extends Component
{
    use WithFileUploads;

    public $currentStep = 1;
    //    public $secondStep = 2;
    //    public $thirdStep = 3;

    public $successMessage = '';
    public $categories, $brands;
    public $images, $tags, $discount, $start_discount, $end_discount, $quantity, $price, $sku;
    public $name_ar, $name_en, $desc_ar, $desc_en, $small_desc_ar, $small_desc_en, $category_id, $brand_id, $available_for;
    public $has_variants = 0, $manage_stock = 0, $has_discount = 0;

    public $fullscreenImage = '';

    public $valueRowCount = 1;

    public function mount($categories, $brands)
    {
        $this->categories = $categories;
        $this->brands = $brands;
    }

    public function deleteImage($key)
    {
        unset($this->images[$key]);
    }

    public function openFullscreen($key)
    {
        $this->fullscreenImage = $this->images[$key]->temporaryUrl();
        $this->dispatch('showFullscreenModal');
    }

    public function render()
    {
        return view('livewire.dashboard.create-product');
    }


    //    protected function rules()
    //    {
    //        return [
    //            'name' => ['required', 'string', 'max:255', 'min:2'],
    //            'desc' => ['required', 'string', 'max:1000', 'min:2'],
    //            'price' => ['required', 'numeric', 'min:0'],
    //            'quantity' => ['required', 'numeric', 'min:0'],
    //        ];
    //    }

    //    public function updated()
    //    {
    //        $this->validate();
    //    }

    public function back($step)
    {
        $this->currentStep = $step;
    }

    public function firstStepSubmit()
    {
        $this->validate([
            'name_ar' => ['required', 'string', 'max:255', 'min:1'],
            'name_en' => ['required', 'string', 'max:255', 'min:1'],
            'desc_ar' => ['required', 'string', 'max:1000', 'min:5'],
            'desc_en' => ['required', 'string', 'max:1000', 'min:5'],
            'small_desc_ar' => ['required', 'string', 'max:400', 'min:5'],
            'small_desc_en' => ['required', 'string', 'max:400', 'min:5'],
            'sku' => ['required', 'string', 'max:255', 'min:1'],
            'category_id' => ['required', 'exists:categories,id'],
            'brand_id' => ['required', 'exists:brands,id'],
            'available_for' => ['required', 'date'],
            'tags' => ['required', 'string'],
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
        if ($this->manage_stock == 1) {
            $data['quantity'] = ['required', 'numeric', 'min:1', 'max:1000000'];
        }
        if ($this->has_discount == 1) {
            $data['discount'] = ['required', 'numeric', 'min:1', 'max:100'];
            $data['start_discount'] = ['required', 'date', 'before:end_discount'];
            $data['end_discount'] = ['required', 'date', 'after:start_discount'];
        }

        $this->validate($data);

        $this->currentStep = 3;
    }

    public function thirdStepSubmit()
    {
        $this->validate([
            'images' => ['required', 'array'],
        ]);
        $this->currentStep = 4;
    }

    public function submitForm()
    {
        try {
            DB::beginTransaction();
            $product = Product::create([
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
                'price' => $this->has_variants == 1 ? null : $this->price,
                'manage_stock' => $this->manage_stock,
                'quantity' => $this->manage_stock == 0 ? null : $this->quantity,
                'discount' => $this->has_discount == 0 ? null : $this->discount,
                'start_discount' => $this->has_discount == 0 ? null : $this->start_discount,
                'end_discount' => $this->has_discount == 0 ? null : $this->end_discount,
            ]);

            // store product images
            ImageManager::uploadImages($this->images, $product, 'products');

            DB::commit();
            $this->successMessage = __('dashboard.success_msg');
            $this->currentStep = 1;
        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }

    //    public function resetForm()
    //    {
    //        $this->name = '';
    //        $this->desc = '';
    //        $this->price = '';
    //        $this->quantity = '';
    //    }
}
