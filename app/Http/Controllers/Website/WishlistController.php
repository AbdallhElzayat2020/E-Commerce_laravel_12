<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function __invoke(Request $request)
    {
        return view('frontend.pages.wishlist-table', [
            'wishlists' => $request->user()->wishlists()->get(),
        ]);
    }
}
