<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\shippingPriceRequest;
use App\Services\Dashboard\WorldService;
use Illuminate\Http\Request;

class WorldController extends Controller
{
    public WorldService $worldService;

    public function __construct(WorldService $worldService)
    {
        $this->worldService = $worldService;
    }

    public function getAllCountries()
    {
        $countries = $this->worldService->getCountries();
        return view('dashboard.pages.world.countries', compact('countries'));
    }

    public function getGovsByCountry($id)
    {
        $governorates = $this->worldService->getAllGovernorates($id);
        return view('dashboard.pages.world.governorates', compact('governorates'));
    }

    public function getCitiesByGovId($id)
    {
        $cities = $this->worldService->getAllCities($id);
        return view('dashboard.pages.world.cities', compact('cities'));
    }


    public function changeStatus($country_id)
    {
        $country = $this->worldService->changeStatus($country_id);
        if (!$country) {
            return response()->json([
                'status' => false,
                'message' => __('dashboard.error_msg')
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => __('dashboard.success_msg'),
            'data' => $country
        ], 200);
    }

    public function changeGovStatus($gov_id)
    {
        $gov = $this->worldService->changeGovStatus($gov_id);
        if (!$gov) {
            return response()->json([
                'status' => false,
                'message' => __('dashboard.error_msg')
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => __('dashboard.success_msg'),
            'data' => $gov
        ], 200);
    }

    public function changeShippingPrice(shippingPriceRequest $request)
    {
        if (!$this->worldService->changeShippingPrice($request)) {
            return redirect()->back()->with('error', __('dashboard.error_msg'));
        }

        $gov = $this->worldService->getGovernorateById($request->gov_id);

        return redirect()->route('dashboard.countries.governorates.index', $gov->country_id)
            ->with('success', __('dashboard.success_msg'));
    }
}
