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
        $item->delete();

        $this->dispatch('refreshCartIcon');
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
        if ($item->quantity > 1) {
            $item->quantity -= 1;
            $item->save();
        }
    }

    public function increaseQuantity($itemId)
    {
        $item = CartItem::find($itemId);
        $item->quantity += 1;
        $item->save();
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
