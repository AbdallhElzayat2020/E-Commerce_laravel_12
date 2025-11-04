@extends('frontend.layouts.master')
@section('title', __('auth.login'))
@section('content')
    <section class="login account footer-padding">
        <div class="container">
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="login-section account-section">
                    <div class="review-form">
                        <h5 class="comment-title">{{ __('dashboard.login') }}</h5>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="account-inner-form">
                            <div class="review-form-name">
                                <label for="email" class="form-label">{{ __('dashboard.email') }}*</label>
                                <input name="email" type="email" id="email" class="form-control"
                                       placeholder="user@gmail.com">
                            </div>
                        </div>

                        <div class="review-form-name address-form">
                            <label for="address" class="form-label">{{ __('dashboard.password') }}*</label>
                            <input name="password" type="password" id="address" class="form-control"
                                   placeholder="{{ __('dashboard.password') }}">
                        </div>

                        <div class="review-form-name checkbox">
                            <div class="checkbox-item d-flex align-items-center">
                                <input type="checkbox" name="remember" id="terms">
                                <label for="terms">{{ __('auth.remember_me') }}
                                    {{ $settings->site_name }}</label>
                            </div>
                        </div>

                        <div class="login-btn text-center">
                            <button type="submit" class="shop-btn">{{ __('dashboard.login') }}</button>
                            <span class="shop-account">{{ __('dashboard.have_account') }} ? <a
                                    href="{{ route('register') }}">{{ __('website.register') }}</a>
                            </span>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </section>

@endsection
