@extends('dashboard.auth.master')
@section('title', __('auth.login'))
@section('content')
    <div class="app-content content" style="min-height: 100vh!important;">
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <section class="flexbox-container">
                    <div class="col-12 d-flex align-items-center justify-content-center" style="margin-top: 80px !important;">
                        <div class="col-md-4 col-10 box-shadow-2 p-0">
                            <div class="card border-grey border-lighten-3 m-0">
                                <div class="card-header border-0">
                                    <div class="card-title text-center">
                                        <img src="{{ asset('assets/dashboard') }}/images/logo/logo-dark.png"
                                            alt="branding logo">
                                    </div>
                                    <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2">
                                        <span>{{ __('auth.login') }}</span>
                                    </h6>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        @include('dashboard.includes.alerts')

                                        <form class="form-horizontal" action="{{ route('dashboard.login.post') }}"
                                            method="post" novalidate>
                                            @csrf
                                            <fieldset class="form-group position-relative has-icon-left">
                                                <input type="text" name="email" value="{{ old('email') }}"
                                                    class="form-control input-lg" id="user-name"
                                                    placeholder="{{ __('auth.email') }}" tabindex="1">
                                                @error('email')
                                                    <p class="text-danger">
                                                        {{ $message }}
                                                    </p>
                                                @enderror
                                                <div class="form-control-position">
                                                    <i class="ft-user"></i>
                                                </div>
                                                <div class="help-block font-small-3"></div>
                                            </fieldset>
                                            <fieldset class="form-group position-relative has-icon-left">
                                                <input type="password" name="password" class="form-control input-lg"
                                                    id="password" placeholder="{{ __('auth.password_filed') }}"
                                                    tabindex="2">
                                                @error('password')
                                                    <p class="text-danger">
                                                        {{ $message }}
                                                    </p>
                                                @enderror
                                                <div class="form-control-position">
                                                    <i class="la la-key"></i>
                                                </div>
                                                <div class="help-block font-small-3"></div>
                                            </fieldset>
                                            <div class="form-group row">
                                                <div class="col-md-6 col-12 text-center text-md-left">
                                                    <fieldset>
                                                        <input type="checkbox" name="remember" id="remember-me"
                                                            class="chk-remember">
                                                        <label for="remember-me">{{ __('auth.remember_me') }}</label>
                                                    </fieldset>
                                                </div>
                                                <div class="col-md-6 col-12 text-center text-md-right">
                                                    <a href="{{ route('dashboard.password.forgot-password') }}"
                                                        class="card-link">{{ __('auth.forgot_password') }}</a>
                                                </div>
                                            </div>

                                            {{-- RECAPTCHA --}}
                                            {{--                                            <div class="form-group row"> --}}
                                            {{--                                                <fieldset> --}}
                                            {{--                                                    <div class="form-group col-md-12 col-12 text-center"> --}}
                                            {{--                                                        {!! NoCaptcha::display() !!} --}}
                                            {{--                                                    </div> --}}
                                            {{--                                                    @error('g-recaptcha-response') --}}
                                            {{--                                                    <p class="text-danger"> --}}
                                            {{--                                                        {{ $message }} --}}
                                            {{--                                                    </p> --}}
                                            {{--                                                    @enderror --}}
                                            {{--                                                </fieldset> --}}
                                            {{--                                            </div> --}}

                                            <button type="submit" class="btn btn-danger btn-block btn-lg">
                                                <i class="ft-unlock"></i> {{ __('auth.login') }}
                                            </button>
                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

@endsection
