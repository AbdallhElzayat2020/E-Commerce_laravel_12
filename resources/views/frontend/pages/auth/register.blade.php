@extends('frontend.layouts.master')
@section('title', __('website.register'))
@section('content')
    <section class="login account footer-padding">
        <div class="container">
            <form action="{{ route('register') }}" method="POST">
                @csrf
                <div class="login-section account-section">
                    <div class="review-form">
                        <h5 class="comment-title">{{ __('dashboard.create_account') }}</h5>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class=" account-inner-form">
                            <div class="review-form-name">
                                <label for="fname" class="form-label">{{ __('dashboard.name') }}*</label>
                                <input name="name" type="text" id="fname" value="{{ old('name') }}"
                                    class="form-control" placeholder="{{ __('dashboard.name') }}">
                            </div>
                        </div>

                        <div class="account-inner-form">
                            <div class="review-form-name">
                                <label for="email" class="form-label">{{ __('dashboard.email') }}*</label>
                                <input name="email" type="email" id="email" value="{{ old('email') }}"
                                    class="form-control" placeholder="user@gmail.com">
                            </div>
                        </div>

                        <div class="review-form-name">
                            @livewire('general.address-drop-down-dependent')
                        </div>

                        <div class="review-form-name address-form">
                            <label for="address" class="form-label">{{ __('dashboard.password') }}*</label>
                            <input name="password" type="password" id="address" class="form-control"
                                placeholder="{{ __('dashboard.password') }}">
                        </div>

                        <div class="review-form-name checkbox">
                            <div class="checkbox-item d-flex align-items-center">
                                <input type="checkbox" name="terms" required id="terms">
                                <label for="terms">{{ __('dashboard.agree_all_termes') }}
                                    {{ $settings->site_name }}</label>
                            </div>
                        </div>

                        <div class="login-btn text-center">
                            <button type="submit" class="shop-btn">{{ __('dashboard.create_account') }}</button>
                            <span class="shop-account">{{ __('dashboard.have_account') }} ?<a
                                    href="{{ route('login') }}">{{ __('dashboard.login') }}</a></span>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>

@endsection
