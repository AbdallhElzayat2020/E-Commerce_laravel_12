<div>
    <div class="form-group">
        <label for="country_id">Country</label>
        <select name="country_id" wire:model.live="countryId" class="form-control" id="country_id">
            <option value="" {{ old('country_id', $countryId ?? '') == '' ? 'selected' : '' }}>Select Country</option>
            @foreach ($countries as $country)
                <option value="{{ $country->id }}"
                    {{ old('country_id', $countryId ?? '') == $country->id ? 'selected' : '' }}>
                    {{ $country->getTranslation('name', app()->getLocale()) }}
                </option>
            @endforeach
        </select>
        @error('country_id')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group">
        <label for="governorate_id">Governorate</label>
        <select name="governorate_id" wire:model.live="governorateId" class="form-control" id="governorate_id">
            <option value="" {{ old('governorate_id', $governorateId ?? '') == '' ? 'selected' : '' }}>Select Governorate</option>
            @foreach ($governorates as $governorate)
                <option value="{{ $governorate->id }}"
                    {{ old('governorate_id', $governorateId ?? '') == $governorate->id ? 'selected' : '' }}>
                    {{ $governorate->getTranslation('name', app()->getLocale()) }}
                </option>
            @endforeach
        </select>
        @error('governorate_id')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group">
        <label for="city_id">City</label>
        <select name="city_id" wire:model="cityId" class="form-control" id="city_id">
            <option value="" {{ old('city_id', $cityId ?? '') == '' ? 'selected' : '' }}>Select City</option>
            @foreach ($cities as $city)
                <option value="{{ $city->id }}"
                    {{ old('city_id', $cityId ?? '') == $city->id ? 'selected' : '' }}>
                    {{ $city->getTranslation('name', app()->getLocale()) }}
                </option>
            @endforeach
        </select>
        @error('city_id')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
</div>
