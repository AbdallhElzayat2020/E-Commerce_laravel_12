<?php

namespace App\Livewire\General;

use App\Models\City;
use App\Models\Country;
use Livewire\Component;
use App\Models\Governorate;

class AddressDropDownDependent extends Component
{

    public $countryId, $governorateId, $cityId;

    public function render()
    {
        return view('livewire.general.address-drop-down-dependent', [
            'countries' => Country::get(),
            'governorates' => $this->countryId ? Governorate::where('country_id', $this->countryId)->get() : [],
            'cities' => $this->governorateId ? City::where('governorate_id', $this->governorateId)->get() : [],
        ]);
    }
}
