<?php

namespace App\Livewire\Website;

use App\Models\Cart;
use App\Models\CartItem;
use Livewire\Component;

class ProductDetails extends Component
{
    public $product;
    public $variantId;
    public $quantity;
    public $price;

    public $cartQuantity = 1;
    public $showVariants = false;
    public $cartAttributesArray = [];  // ['attribute_id'=>attribute_value]

    public function mount($product)
    {
        $this->product = $product;
        $firstVariant = $this->product->variants->first();

        $this->variantId = $product->has_variants ? optional($firstVariant)->id : null;

        // For simple products use product price (respecting discount if exists)
        if (!$product->has_variants) {
            $this->price = $product->has_discount
                ? $product->getPriceAfterDiscount()
                : $product->price;
            $this->quantity = $product->quantity;
        } else {
            $this->price = optional($firstVariant)->price;
            $this->quantity = optional($firstVariant)->stock;
        }
    }

    public function changeVariant($variantId)
    {
        $variant = $this->product->variants->find($variantId);
        if (!$variant) {
            return;
        }
        $this->changePropertiesValues($variant);
    }

    public function changePropertiesValues($variant)
    {
        $this->variantId = $variant->id;
        $this->price = $variant->price;
        $this->quantity = $variant->stock;
    }


    /* cart Functions */
    public function decrementCartQuantity()
    {
        if ($this->cartQuantity > 1) {
            $this->cartQuantity--;
        }
    }

    public function incrementCartQuantity()
    {
        $this->cartQuantity++;
    }

    public function addToCart()
    {
        $product = $this->product;
        $userId = auth('web')->user()->id;
        $cart = Cart::firstOrCreate(['user_id' => $userId]);


        // check simple & store simple product
        if (!$product->has_variants) {

            $cartItem = CartItem::where('cart_id', $cart->id)
                ->where('product_id', $product->id)
                ->whereNull('product_variant_id')
                ->first();

            if ($cartItem) {

                $cartItem->increment('quantity', $this->cartQuantity);
            } else {
                $cart->cartItems()->create([
                    'product_id' => $product->id,
                    'product_variant_id' => null,
                    'price' => $this->price,
                    'quantity' => $this->cartQuantity,
                ]);
            }
        }

        // check if product has variants
        if ($product->has_variants) {

            $variant = $product->variants->find($this->variantId);
            $variant->load('VariantAttribute');

            // check if variant exists in cart
            $cartItem = CartItem::where('cart_id', $cart->id)
                ->where('product_variant_id', $variant->id)
                ->first();

            if ($cartItem) {
                $cartItem->increment('quantity', $this->cartQuantity);
            } else {
                foreach ($variant->VariantAttribute as $attribute) {
                    $this->cartAttributesArray[$attribute->attributeValue->attribute->name] = $attribute->attributeValue->value;
                }

                $item = $cart->cartItems()->create([
                    'product_id' => $product->id,
                    'product_variant_id' => $this->variantId,
                    'price' => $variant->price,
                    'quantity' => $this->cartQuantity,
                    'attributes' => json_decode($this->cartAttributesArray,JSON_UNESCAPED_UNICODE)
                ]);
            }

        }

        $this->dispatch('successMessage', __('website.product_add_to_cart'));
        $this->dispatch('refreshCartIcon');
    }

    public function render()
    {
        return view('livewire.website.product-details', [
            'variants' => $this->product->variants
        ]);
    }
}
