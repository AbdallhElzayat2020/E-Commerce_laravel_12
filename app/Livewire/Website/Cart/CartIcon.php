<?php

namespace App\Livewire\Website\Cart;

use Livewire\Attributes\On;
use Livewire\Component;

class CartIcon extends Component
{
    public function removeItemFromCart($id)
    {
        $authBoolean = auth('web')->check();
        if ($authBoolean) {
            $cart = auth('web')->user()->cart;
            if ($cart) {
                $cartItem = $cart->cartItems()->where('id', $id)->first();
                if ($cartItem) {
                    $cartItem->delete();
                    $this->dispatch('refreshCartIcon');
                    $this->dispatch('updateCart');
                    $this->dispatch('orderSummaryRefresh');
                }
            }
        }
    }

    #[On('refreshCartIcon')]
    public function render()
    {
        $authBoolean = auth('web')->check();

        if (!$authBoolean) {
            return view('livewire.website.cart.cart-icon', [
                'cartItems' => collect([]),
                'cartItemsCount' => 0
            ]);
        }

        $cart = auth('web')->user()->cart;

        if ($cart) {
            $cart->loadMissing('cartItems.product.images');
        }

        $cartItemsCount = $cart ? $cart->cartItems->count() : 0;
        $cartItems = $cart ? $cart->cartItems : collect([]);

        return view('livewire.website.cart.cart-icon', [
            'cartItems' => $cartItems,
            'cartItemsCount' => $cartItemsCount
        ]);
    }
}
