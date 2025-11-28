<?php

namespace App\Livewire\Website\Wishlist;

use App\Models\Wishlist as ModelsWishlist;
use Livewire\Component;


class Wishlist extends Component
{
    public $product;
    public $inWishlist = false;

    public function mount($product)
    {
        $this->product = $product;

        if (auth('web')->check()) {

            $status = ModelsWishlist::where('product_id', $product->id)
                ->where('user_id', auth('web')->user()->id)->first();
            $status ? $this->inWishlist = true : $this->inWishlist = false;
        }
    }

    public function addToWishlist($productId)
    {
        if (!auth('web')->check()) {
            return redirect()->route('login');
        }

        ModelsWishlist::create([
            'product_id' => $productId,
            'user_id' => auth('web')->user()->id,
        ]);
        $this->inWishlist = true;

        $this->dispatch('addToWishlist', __('website.product_added_to_wishlist'));
        // event to increment wishlist count
        $this->dispatch('wishlistCountRefresh');
    }

    public function removeFromWishlist($productId)
    {
        if (!auth('web')->check()) {
            return redirect()->route('login');
        }

        $wishlistProduct = ModelsWishlist::where('product_id', $productId)
            ->where('user_id', auth('web')->user()->id)
            ->first();
        if ($wishlistProduct) {
            $wishlistProduct->delete();
            $this->inWishlist = false;
        }

        $this->dispatch('removeFromWishlist', __('website.product_removed_from_wishlist'));
        // event to decrement wishlist count
        $this->dispatch('wishlistCountRefresh');
    }

    public function render()
    {
        return view('livewire.website.wishlist.wish-list');
    }
}
