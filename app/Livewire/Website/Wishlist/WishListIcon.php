<?php

namespace App\Livewire\Website\Wishlist;

use Livewire\Attributes\On;
use Livewire\Component;

class WishListIcon extends Component
{
    #[On('wishlistCountRefresh')]

    public function render()
    {
        $user = auth('web')->user();
        $count = $user ? $user->wishlists()->count() : 0;
        return view('livewire.website.wishlist.wish-list-icon', [
            'wishlistsCount' => $count
        ]);
    }
}
