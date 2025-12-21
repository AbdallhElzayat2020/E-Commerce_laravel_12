<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Http\Requests\Website\OrderShipping\OrderShippingRequest;
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

    public function checkout(OrderShippingRequest $request)
    {
        $shipping = $request->validated();
        $createOrder = $this->checkoutService->createOrder($shipping);

        if (!$createOrder) {
            return redirect()->back()->with('error', 'Something went wrong');
        }

        return redirect()->back()->with('success', 'Order created successfully');

    }
}
