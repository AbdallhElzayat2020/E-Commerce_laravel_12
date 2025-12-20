<div>
    <div class="checkout-wrapper">
        <div class="account-section billing-section">
            <h5 class="wrapper-heading">Billing Details</h5>
            <div class="review-form">
                <div class=" account-inner-form">
                    <div class="review-form-name">
                        <label for="fname" class="form-label">First Name<span class="text-danger">*</span></label>
                        <input type="text" id="fname" class="form-control" placeholder="First Name">
                    </div>
                    <div class="review-form-name">
                        <label for="lname" class="form-label">Last Name<span class="text-danger">*</span></label>
                        <input type="text" id="lname" class="form-control" placeholder="Last Name">
                    </div>
                </div>
                <div class=" account-inner-form">
                    <div class="review-form-name">
                        <label for="email" class="form-label">Email<span class="text-danger">*</span></label>
                        <input type="email" id="email" class="form-control"
                               placeholder="user@gmail.com">
                    </div>
                    <div class="review-form-name">
                        <label for="phone" class="form-label">Phone<span class="text-danger">*</span></label>
                        <input type="tel" id="phone" class="form-control" placeholder="+880388**0899">
                    </div>
                </div>
                {{-- Country --}}
                <div class="form-group  mt-3">
                    <label for="country_id">Country <span class="text-danger">*</span></label>
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
                {{-- Governorate --}}
                <div class="form-group  mt-3 ">
                    <label for="governorate_id">Governorate<span class="text-danger">*</span></label>
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
                {{-- City --}}
                <div class="form-group mt-3">
                    <label for="city_id">City<span class="text-danger">*</span></label>
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

                <a href="#" class="shop-btn mt-5">Place Order Now</a>
            </div>
        </div>
    </div>
</div>
