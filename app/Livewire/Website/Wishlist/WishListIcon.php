<?php

namespace App\Livewire\Website\Wishlist;

use Livewire\Attributes\On;
use Livewire\Component;

class WishListIcon extends Component
{
    #[On('wishlistCountRefresh')]

    public function render()
    {
        $count = auth('web')->user() ? auth('web')->user()->wishlists()->get()->count() : 0;
        return view('livewire.website.wishlist.wish-list-icon', [
            'wishlistsCount' => $count
        ]);
    }
}
