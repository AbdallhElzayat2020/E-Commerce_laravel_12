<?php

namespace App\Livewire\Website\Wishlist;

use App\Models\Wishlist as ModelsWishlist;
use Livewire\Component;

class WishListTable extends Component
{

    public function removeFromWishlist($wishlistId)
    {
        $wishlist = ModelsWishlist::find($wishlistId);
        if ($wishlist) {
            $wishlist->delete();
        }
        $this->dispatch('wishlistCountRefresh');
    }

    public function clearWishlist()
    {
        auth('web')->user()->wishlists()->delete();
        $this->dispatch('wishlistCountRefresh');
    }

    public function render()
    {
        $wishlists = auth('web')->user()->wishlists()->get();
        return view('livewire.website.wishlist.wish-list-table', [
            'wishlists' => $wishlists
        ]);
    }
}
