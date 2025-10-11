<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Store\StoreCouponRequest;
use App\Http\Requests\Dashboard\Update\UpdateCouponRequest;
use App\Services\Dashboard\CouponService;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CouponController extends Controller
{
    protected CouponService $couponService;

    public function __construct(CouponService $couponService)
    {
        $this->couponService = $couponService;
    }

    public function getAll()
    {
        return $this->couponService->getAllCouponsForDataTable();
    }

    public function index()
    {
        return view('dashboard.pages.coupons.index');
    }


    public function create()
    {
    }


    public function store(StoreCouponRequest $request)
    {
        $data = $request->except('_token');
        $coupon = $this->couponService->createCoupon($data);

        if (!$coupon) {
            return response()->json([
                'status' => 'error',
                'message' => __('dashboard.error_msg'),
            ], 500);
        }

        return response()->json([
            'status' => 'success',
            'message' => __('dashboard.success_msg'),
        ], 201);
    }

    public function update(UpdateCouponRequest $request, string $id)
    {
        $data = $request->except('_token', '_method');
        $coupon = $this->couponService->updateCoupon($id, $data);
        if (!$coupon) {
            return response()->json([
                'status' => 'error',
                'message' => __('dashboard.error_msg'),
            ], 500);
        }
        return response()->json([
            'status' => 'success',
            'message' => __('dashboard.success_msg'),
        ], 200);
    }


    public function destroy(string $id)
    {
        if (!$this->couponService->deleteCoupon($id)) {
            return response()->json([
                'status' => 'error',
                'message' => __('dashboard.error_msg'),
            ], 500);
        }
        return response()->json([
            'status' => 'success',
            'message' => __('dashboard.success_msg'),
        ], 200);
    }
}
