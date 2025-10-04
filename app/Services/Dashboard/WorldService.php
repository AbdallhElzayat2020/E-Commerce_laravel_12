<?php

namespace App\Services\Dashboard;

use App\Models\Country;
use App\Repositories\Dashboard\WorldRepository;

class WorldService
{
    public WorldRepository $worldRepository;

    public function __construct(WorldRepository $worldRepository)
    {
        $this->worldRepository = $worldRepository;
    }

    public function getCountryById($id)
    {
        $country = $this->worldRepository->getCountryById($id);
        if (!$country) {
            abort(404);
        }
        return $country;
    }

    public function getGovernorateById($id)
    {
        $governorate = $this->worldRepository->getGovernorateById($id);
        if (!$governorate) {
            abort(404);
        }
        return $governorate;
    }


    public function getCountries()
    {
        return $this->worldRepository->getAllCountries();
    }

    public function getAllGovernorates($country_id)
    {
        $country = self::getCountryById($country_id);
        return $this->worldRepository->getAllGovernorates($country);
    }

    public function getAllCities($governorate_id)
    {
        $governorate = self::getGovernorateById($governorate_id);
        return $this->worldRepository->getAllCities($governorate);
    }

    public function changeStatus($country_id)
    {
        $country = self::getCountryById($country_id);
        $result = $this->worldRepository->changeStatus($country);

        if (!$result) {
            return false;
        }
        return $result;
    }

    public function changeGovStatus($gov_id)
    {
        $gov = self::getGovernorateById($gov_id);
        $result = $this->worldRepository->changeStatus($gov);

        if (!$result) {
            return false;
        }
        return $result;
    }

    public function changeShippingPrice($request)
    {
        $governorate = self::getGovernorateById($request->gov_id);
        $governorate = $this->worldRepository->changeShippingPrice($governorate, $request->price);

        if (!$governorate) {
            return false;
        }
        return true;
    }
}
