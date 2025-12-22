<?php

namespace App\Livewire\Website\Checkout;

use App\Models\Cart;
use App\Models\Coupon as CouponModel;
use Livewire\Attributes\On;
use Livewire\Component;

class Coupons extends Component
{
    public $code;
    public $cart;
    public $cartItemsCount = 0;
    public $couponInfo = null;

    public function mount(): void
    {
        $this->loadCartData();
    }

    #[On('orderSummaryRefresh')]
    public function loadCartData(): void
    {
        if (!auth('web')->check()) {
            $this->cart = null;
            $this->cartItemsCount = 0;
            $this->couponInfo = null;
            return;
        }

        $this->cart = Cart::with('cartItems')
            ->where('user_id', auth('web')->id())
            ->first();

        $this->cartItemsCount = $this->cart?->cartItems->count() ?? 0;

        if ($this->cart?->coupon) {
            $couponObj = CouponModel::valid()->where('code', $this->cart->coupon)->first();
            if ($couponObj) {
                $this->couponInfo = 'Coupon Applied with Discount ' . $couponObj->discount_percentage . '%';
            }
        } else {
            $this->couponInfo = null;
        }
    }

    // check coupon if is valid
    public function checkCouponValid($code)
    {
        $couponObj = CouponModel::where('code', $code)->first();
        if (!$couponObj) {
            return false;
        }
        if (!$couponObj->couponIsValid()) {
            return false;
        }
        return $couponObj;
    }

    // apply coupon
    public function applyCoupon()
    {
        // check coupon is valid
        if (!$this->checkCouponValid($this->code)) {
            $this->dispatch('couponNotValid', 'Coupon Not Valid');
            return;
        }

        $cart = Cart::where('user_id', auth('web')->id())->first();
        if (!$cart) {
            $this->dispatch('couponNotValid', 'Cart not found');
            return;
        }

        $cart->update(['coupon' => $this->code]);

        // decrease coupon count
        $couponObj = CouponModel::where('code', $this->code)->first();

        $couponObj->update([
            'time_used' => $couponObj->time_used + 1,
        ]);

        $this->couponInfo = 'Coupon Applied with Discount' . $couponObj->discount_percentage . '%';
        $this->dispatch('couponApplied', $this->couponInfo);
    }

    public function render()
    {
        return view('livewire.website.checkout.coupons');
    }
}
