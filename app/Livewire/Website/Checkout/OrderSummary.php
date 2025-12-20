<?php

namespace App\Livewire\Website\Checkout;

use App\Models\Cart;
use Livewire\Attributes\On;
use Livewire\Component;

class OrderSummary extends Component
{

    public $shippingPrice = 0;


    #[On('shippingPriceUpdated')]
    public function updateShippingPrice($price)
    {
        $this->shippingPrice = $price;
    }

    #[On('orderSummaryRefresh')]
    public function render()
    {
        $user = auth('web')->user();
        $cart = $user->cart;

        if ($cart) {
            $cart->loadMissing('cartItems.product');
        }
        return view('livewire.website.checkout.order-summary', [
            'cart' => $cart,
        ]);
    }
}
