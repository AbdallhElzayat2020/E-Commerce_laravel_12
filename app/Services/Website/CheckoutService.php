<?php

namespace App\Services\Website;

use App\Models\Cart;
use App\Models\City;
use App\Models\Order;
use App\Models\Country;
use App\Models\Coupon;
use App\Models\Governorate;
use App\Models\ShippingGovernorate;

class CheckoutService
{
    public function createOrder($data)
    {
        $countryName = $this->getLocationName(Country::class, $data['country_id']);
        $governorateName = $this->getLocationName(Governorate::class, $data['governorate_id']);
        $cityName = $this->getLocationName(City::class, $data['city_id']);

        if (!$countryName || !$governorateName || !$cityName) {
            return null;
        }

        $cart = $this->getUserCart();
        if (!$cart || $cart->cartItems->isEmpty()) {
            return null;
        }

        $subTotal = $cart->cartItems->sum(fn($item) => $item->price * $item->quantity);
        $shippingPrice = $this->getShippingPrice($data['governorate_id']);

        $totalPrice = $subTotal + $shippingPrice;

        // check if user has a coupon
        $coupon = null;
        $coupon_exists = $cart->coupon != null;

        if ($coupon_exists) {
            $coupon = Coupon::valid()->where('code', trim($cart->coupon, ' '))->first();

            if ($coupon) {
                $totalPrice = $totalPrice - ($totalPrice * $coupon->discount_percentage / 100);
            }
        }

        // store order
        $order = Order::create([
            'user_id' => auth('web')->user()->id,
            'user_name' => $data['first_name'] . ' ' . $data['last_name'],
            'user_email' => $data['user_email'],
            'user_phone' => $data['user_phone'],
            'country' => $countryName,
            'governorate' => $governorateName,
            'city' => $cityName,
            'street' => $data['street'],
            'notes' => $data['notes'] ?? null,
            'price' => $subTotal,
            'shipping_price' => $shippingPrice,
            'total_price' => $totalPrice,
            'coupon' => $coupon_exists && $coupon ? $coupon->code : '',
            'coupon_discount' => $coupon_exists && $coupon ? $coupon->discount_percentage : 0,
        ]);

        $this->storeOrderItemsForCart($order, $cart);
        // $this->clearUserCart($cart);

        return $order;
    }

    public function getLocationName(string $modelClass, int $id): ?string
    {
        return $modelClass::find($id)?->name;
    }

    public function getUserCart()
    {
        return Cart::with(['cartItems.product'])->where('user_id', auth('web')->id())->first();
    }

    public function getShippingPrice($governorate_id)
    {
        return ShippingGovernorate::where('governorate_id', $governorate_id)->value('price') ?? 0.0;
    }

    public function storeOrderItemsForCart($order, $cart)
    {
        foreach ($cart->cartItems as $item) {
            $order->orderItems()->create([
                'product_id' => $item->product_id,
                'product_variant_id' => $item->product_variant_id,
                'product_name' => optional($item->product)->name ?? 'Unknown Product',
                'product_description' => optional($item->product)->description ?? 'No Description',
                'product_price' => $item->price,
                'quantity' => $item->quantity,
                'data' => json_encode($item->attributes),
            ]);
        }
    }
    public function clearUserCart($cart)
    {
        $cart->cartItems()->delete();
        $cart->update(['coupon' => null]);
    }
}
