<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Services\Website\CheckoutService;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{

    protected $checkoutService;

    public function __construct(CheckoutService $checkoutService)
    {
        $this->checkoutService = $checkoutService;
    }

    public function showCheckoutPage()
    {
        return view('frontend.pages.checkout');
    }
}
