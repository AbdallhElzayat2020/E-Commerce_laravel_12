<?php

namespace App\Livewire\Website\Cart;

use App\Models\CartItem;
use Livewire\Attributes\On;
use Livewire\Component;

class CartTablePage extends Component
{

    public function removeItem($itemId)
    {
        $item = CartItem::find($itemId);

        if ($item) {
        $item->delete();

            // Dispatch events to update all components
        $this->dispatch('refreshCartIcon');
            $this->dispatch('updateCart');
            $this->dispatch('orderSummaryRefresh');
        }
    }

    public function clearCart()
    {
        $authUser = auth('web')->user();
        $cart = $authUser->cart;
        $cart->cartItems()->delete();

        $this->dispatch('refreshCartIcon');
    }

    public function decreaseQuantity($itemId)
    {
        $item = CartItem::find($itemId);
        if ($item && $item->quantity > 1) {
            $item->quantity -= 1;
            $item->save();

            $this->dispatch('refreshCartIcon');
            $this->dispatch('orderSummaryRefresh');
        }
    }

    public function increaseQuantity($itemId)
    {
        $item = CartItem::find($itemId);
        if ($item) {
        $item->quantity += 1;
        $item->save();

            $this->dispatch('refreshCartIcon');
            $this->dispatch('orderSummaryRefresh');
        }
    }

    #[On('updateCart')]
    public function render()
    {
        $authUser = auth('web')->user();
        $cart = $authUser->cart;

        if (!$cart) {
            return view('livewire.website.cart.cart-table-page', [
                'cartItems' => collect([]),
            ]);
        }

        $cart->load('cartItems.product.images');

        // Ensure attributes are properly decoded for each cart item
        $cartItems = $cart->cartItems->map(function ($item) {
            // If attributes is still a string, decode it
            if (is_string($item->attributes)) {
                $item->attributes = json_decode($item->attributes, true);
            }
            return $item;
        });
        return view('livewire.website.cart.cart-table-page', [
            'cartItems' => $cartItems,
        ]);
    }
}
