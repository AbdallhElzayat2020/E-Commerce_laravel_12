<?php

namespace App\Livewire\Website\Checkout;

use App\Models\City;
use App\Models\Country;
use App\Models\Governorate;
use App\Models\ShippingGovernorate;
use Livewire\Component;

class ShippingDetails extends Component
{

    public $countryId, $governorateId, $cityId;

    public function updatedGovernorateId()
    {
        $price = ShippingGovernorate::where('governorate_id', $this->governorateId)->first()->price;
        $this->dispatch('shippingPriceUpdated', $price);
    }

    public function render()
    {
        return view('livewire.website.checkout.shipping-details', [
            'countries' => Country::where('is_active', 1)->get(),

            'governorates' => $this->countryId ? Governorate::where('country_id', $this->countryId)
                ->where('is_active', 1)->get() : [],

            'cities' => $this->governorateId ? City::where('governorate_id', $this->governorateId)->get() : [],
        ]);
    }
}
