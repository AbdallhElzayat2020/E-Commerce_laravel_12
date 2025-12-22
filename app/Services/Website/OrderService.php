<?php

namespace App\Services\Website;

use App\Models\Cart;
use App\Models\City;
use App\Models\Order;
use App\Models\Coupon;
use App\Models\Country;
use App\Models\Governorate;
use App\Models\Transaction;
use App\Models\ShippingGovernorate;
use Illuminate\Support\Facades\Auth;

class OrderService
{
    public function getInvoiceValue($address)
    {
        $governorateName = $this->getLocationName(Governorate::class, $address['governorate_id']);

        $cart = $this->getUserCart();
        if (!$cart || $cart->cartItems->isEmpty()) {
            return null;
        }

        $subTotal = $cart->cartItems->sum(fn($item) => $item->price * $item->quantity);
        $shippingPrice = $this->getShippingPrice($address['governorate_id']);

        // check if user has coupon
        $coupon_exists = $cart->coupon != null;
        $coupon = null;
        if ($coupon_exists) {
            $coupon = Coupon::valid()->where('code', trim($cart->coupon, ' '))->first();
            if ($coupon) {
                $subTotal = $subTotal - ($subTotal * $coupon->discount_precentage / 100);
            }
        }
        $totalPrice = $subTotal + $shippingPrice;

        return $totalPrice;
    }

    public function createTransaction($data, $orderId)
    {
        $transaction = Transaction::create([
            'user_id' => Auth::guard('web')->user()->id,
            'order_id' => $orderId,
            'transaction_id' => $data['Data']['InvoiceId'],
            'payment_method' => 'Payment',
        ]);
        return $transaction;
    }

    public function createOrder(array $address): ?Order
    {
        $countryName = $this->getLocationName(Country::class, $address['country_id']);
        $governorateName = $this->getLocationName(Governorate::class, $address['governorate_id']);
        $cityName = $this->getLocationName(City::class, $address['city_id']);

        if (!$countryName || !$governorateName || !$cityName) {
            return null;
        }

        $cart = $this->getUserCart();
        if (!$cart || $cart->cartItems->isEmpty()) {
            return null;
        }


        $subTotal = $cart->cartItems->sum(fn($item) => $item->price * $item->quantity);
        $shippingPrice = $this->getShippingPrice($address['governorate_id']);

        // check if user has coupon
        $coupon_exists = $cart->coupon != null;
        $coupon = null;
        if ($coupon_exists) {
            $coupon = Coupon::valid()->where('code', trim($cart->coupon, ' '))->first();
            if ($coupon) {
                $subTotal = $subTotal - ($subTotal * $coupon->discount_precentage / 100);
            }
        }
        $totalPrice = $subTotal + $shippingPrice;

        // store order
        $order = Order::create([
            'user_id' => auth('web')->user()->id,
            'user_name' => $address['first_name'] . ' ' . $address['last_name'],
            'user_phone' => $address['user_phone'],
            'user_email' => $address['user_email'],
            'country' => $countryName,
            'governorate' => $governorateName,
            'city' => $cityName,
            'street' => $address['street'],
            'notes' => $address['notes'],
            'price' => $subTotal,
            // correct column name is `shipping_price` in orders table
            'shipping_price' => $shippingPrice,
            'total_price' => $totalPrice,
            // coupon column is NOT NULL in DB, so send empty string if no coupon
            'coupon' => $coupon && $coupon_exists ? $coupon->code : '',
            'coupon_discount' => $coupon && $coupon_exists ? $coupon->discount_precentage : 0,
        ]);

        $this->storeOrderItemsFromCart($order, $cart);

        return $order;
    }

    private function getLocationName(string $modelClass, int $id): ?string
    {
        return $modelClass::find($id)?->name;
    }

    private function getUserCart(): ?Cart
    {
        return Cart::with('cartItems.product')->where('user_id', auth('web')->user()->id)->first();
    }

    private function getShippingPrice(int $governorateId): float
    {
        return ShippingGovernorate::where('governorate_id', $governorateId)->value('price') ?? 0.0;
    }

    private function storeOrderItemsFromCart(Order $order, Cart $cart): void
    {
        foreach ($cart->cartItems as $item) {
            $order->orderItems()->create([
                'product_id' => $item->product_id,
                'product_variant_id' => $item->product_variant_id,
                'product_name' => optional($item->product)->name ?? 'Unknown Product',
                'product_description' => optional($item->product)->small_desc ?? '',
                'quantity' => $item->quantity,
                'product_price' => $item->price,
                'data' => json_encode($item->attributes),
            ]);
        }
    }

    public function clearUserCart(Cart $cart): void
    {
        $cart->CartItems()->delete();
        $cart->update(['coupon' => null]); // clear coupon
    }
}
