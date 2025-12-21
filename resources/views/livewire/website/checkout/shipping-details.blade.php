<div>
    <form action="{{ route('website.checkout.post') }}" method="post">
        @csrf
        <div class="checkout-wrapper">
            <div class="account-section billing-section">
                <h5 class="wrapper-heading">Shipping Address</h5>
                <div class="review-form">
                    <div class=" account-inner-form">
                        <div class="review-form-name">
                            <label for="fname" class="form-label">First Name*</label>
                            <input name="first_name" type="text" id="fname" class="form-control"
                                placeholder="First Name">
                            @error('first_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="review-form-name">
                            <label for="lname" class="form-label">Last Name*</label>
                            <input name="last_name" type="text" id="lname" class="form-control" placeholder="Last Name">
                            @error('last_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class=" account-inner-form">
                        <div class="review-form-name">
                            <label for="email" class="form-label">Email*</label>
                            <input name="user_email" type="email" id="email" class="form-control"
                                placeholder="user@gmail.com">
                            @error('user_email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="review-form-name">
                            <label for="phone" class="form-label">Phone*</label>
                            <input name="user_phone" type="tel" id="phone" class="form-control"
                                placeholder="+880388**0899">
                            @error('user_phone')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="country_id">Country</label>
                        <select name="country_id" wire:model.live="countryId" class="form-control" id="country_id">
                            <option value="" selected>Select Country</option>
                            @foreach ($countries as $country)
                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                            @endforeach
                        </select>
                        @error('country_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group mt-4">
                        <label for="governorate_id">Governorate</label>
                        <select name="governorate_id" wire:model.live="governorateId" class="form-control"
                            id="governorate_id">
                            <option value="" selected>Select Governorate</option>
                            @foreach ($governorates as $governorate)
                                <option value="{{ $governorate->id }}">{{ $governorate->name }}</option>
                            @endforeach
                        </select>
                        @error('governorate_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group mt-4">
                        <label for="city_id">City</label>
                        <select name="city_id" wire:model="cityId" class="form-control" id="city_id">
                            <option value="" selected>Select City</option>
                            @foreach ($cities as $city)
                                <option value="{{ $city->id }}">{{ $city->name }}</option>
                            @endforeach
                        </select>
                        @error('city_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group mt-4">
                        <label for="street">Street Name</label>
                        <input name="street" type="text" id="phone" class="form-control" placeholder="street name">
                        @error('street')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group mt-4">
                        <label for="notes">Notice</label>
                        <input name="notes" type="text" id="notes" class="form-control" placeholder="notice name">
                        @error('notes')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <button type="submit" class="shop-btn">Place Order Now</button>

        </div>
    </form>
</div>
