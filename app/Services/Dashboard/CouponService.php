<?php

namespace App\Services\Dashboard;

use App\Models\Coupon;
use App\Repositories\Dashboard\CouponRepository;
use Yajra\DataTables\Facades\DataTables;

class CouponService
{
    protected CouponRepository $couponRepository;

    public function __construct(CouponRepository $couponRepository)
    {
        $this->couponRepository = $couponRepository;
    }

    public function getAllCouponsForDataTable()
    {
        $coupons = $this->couponRepository->getAllCoupons();
        return DataTables::of($coupons)
            ->addIndexColumn()
            ->addColumn('status', function ($coupon) {
                return view('dashboard.pages.coupons.datatables.status', compact('coupon'))->render();
            })
            ->addColumn('actions', function ($coupon) {
                return view('dashboard.pages.coupons.datatables.actions', compact('coupon'))->render();
            })
            ->rawColumns(['actions', 'status'])
            ->make(true);
    }

    public function getCouponById($id)
    {
        $coupon = $this->couponRepository->getCouponById($id);
        if (!$coupon) {
            abort(404);
        }
        return $coupon;
    }

    public function createCoupon($data)
    {
        return $this->couponRepository->createCoupon($data);
    }
    public function updateCoupon($id, $data)
    {
        $coupon = $this->getCouponById($id);
        return $this->couponRepository->updateCoupon($coupon, $data);
    }

    public function deleteCoupon($id)
    {
        $coupon = self::getCouponById($id);
        return $this->couponRepository->deleteCoupon($coupon);
    }
}
