<?php

namespace App\Repositories\Dashboard;

use App\Models\City;
use App\Models\Country;
use App\Models\Governorate;
use Illuminate\Support\Facades\DB;

class WorldRepository
{
    public function getAllCountries()
    {
//        return Country::withCount('governorates')
//            ->selectRaw('countries.*, (SELECT COUNT(*) FROM users
//                INNER JOIN cities ON users.city_id = cities.id
//                INNER JOIN governorates ON cities.governorate_id = governorates.id
//                WHERE governorates.country_id = countries.id) as users_count')
//            ->when(!empty(request()->keyword), function ($query) {
//                $query->where('countries.name', 'like', '%' . request()->keyword . '%');
//            })->paginate(9);


        return Country::withCount(['governorates', 'users'])
            ->when(!empty(request()->keyword), function ($query) {
                $query->where('name', 'like', '%' . request()->keyword . '%');
            })->paginate(9);
    }

    public function getCountryById($id)
    {
        return Country::find($id);
    }

    public function getGovernorateById($id)
    {
        return Governorate::find($id);
    }


    public function getAllGovernorates($country)
    {
        return $country->governorates()
            ->with(['country', 'shippingPrice'])
            ->withCount(['cities', 'users'])
            ->when(!empty(request()->keyword), function ($query) {
                $query->where('name', 'like', '%' . request()->keyword . '%');
            })->paginate(9);
    }

    public function getAllCities($governorate)
    {
        return $governorate->cities;
    }

    public function changeStatus($model)
    {
        $tableName = $model->getTable();
        $modelId = $model->id;

        // Get current status directly from database
        $currentRecord = DB::table($tableName)->where('id', $modelId)->first();
        $currentStatus = $currentRecord->is_active ?? 0;

        // Toggle the status
        $newStatus = ($currentStatus == 1 || $currentStatus === true) ? 0 : 1;

        // Update in database
        DB::table($tableName)
            ->where('id', $modelId)
            ->update(['is_active' => $newStatus, 'updated_at' => now()]);

        // Refresh the model to get updated data
        $model->refresh();

        return $model;
    }


    public function changeShippingPrice($governorate, $price)
    {
        return $governorate->shippingPrice->update([
            'price' => $price,
        ]);
    }
}
