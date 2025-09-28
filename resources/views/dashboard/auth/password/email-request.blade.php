@extends('dashboard.auth.master')
@section('title', 'Reset Password Request')
@section('content')
    <div class="content-body">
        <section class="flexbox-container">
            <div class="col-12 d-flex align-items-center justify-content-center" style="min-height: 80vh!important;">
                <div class="col-md-4 col-10 box-shadow-2 p-0">
                    <div class="card border-grey border-lighten-3 px-2 py-2 m-0">
                        <div class="card-header border-0 pb-0">
                            <div class="card-title text-center">
                                <img src="{{ asset('assets/dashboard') }}/images/logo/logo-dark.png" alt="branding logo">
                            </div>
                            <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2">
                                <span>We will send you an OTP code to reset your password</span>
                            </h6>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                @include('dashboard.includes.alerts')

                                <form class="form-horizontal" action="{{ route('dashboard.password.send-reset-link') }}"
                                    method="post">
                                    @csrf

                                    <!-- Email Input Field -->
                                    <fieldset class="form-group position-relative has-icon-left">
                                        <input type="email" name="email" value="{{ old('email') }}"
                                            class="form-control form-control-lg input-lg @error('email') is-invalid @enderror"
                                            placeholder="Your Email Address" autocomplete="email">
                                        @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <div class="form-control-position">
                                            <i class="ft-mail"></i>
                                        </div>
                                    </fieldset>

                                    <!-- Submit Button -->
                                    <button type="submit" class="btn btn-outline-info btn-lg btn-block">
                                        <i class="ft-unlock"></i> Send OTP Code
                                    </button>
                                </form>
                            </div>
                        </div>
                        <div class="card-footer border-0">
                            <p class="float-sm-left text-center">
                                <a href="{{ route('dashboard.login') }}" class="card-link">
                                    <i class="ft-arrow-left"></i> Back to Login
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
