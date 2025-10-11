<?php

namespace App\Repositories\Dashboard;

use App\Models\Coupon;

class CouponRepository
{
    public function getAllCoupons()
    {
        return Coupon::query()->latest()->get();
    }

    public function getCouponById($id)
    {
        return Coupon::find($id);
    }

    public function createCoupon($data)
    {
        return Coupon::create($data);
    }

    public function updateCoupon($coupon, $data)
    {
        return $coupon->update($data);
    }

    public function deleteCoupon($coupon)
    {
        return $coupon->delete();
    }

}
