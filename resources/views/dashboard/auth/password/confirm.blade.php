@extends('dashboard.auth.master')
@section('title', 'OTP Verification')
@section('content')
    <div class="content-body">
        <section class="flexbox-container">
            <div class="col-12 d-flex align-items-center justify-content-center" style="min-height: 70vh!important;">
                <div class="col-md-4 col-10 box-shadow-2 p-0">
                    <div class="card border-grey border-lighten-3 px-2 py-2 m-0">
                        <div class="card-header border-0 pb-0">
                            <div class="card-title text-center">
                                <img src="{{ asset('assets/dashboard') }}/images/logo/logo-dark.png" alt="branding logo">
                            </div>
                            <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2">
                                <span>Enter the verification code sent to: <strong>{{ $email }}</strong></span>
                            </h6>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                @include('dashboard.includes.alerts')

                                <form class="form-horizontal" action="{{ route('dashboard.password.verify-otp-form') }}"
                                    method="post">
                                    @csrf

                                    <!-- Hidden fields -->
                                    <div class="form-group">
                                        <input hidden type="email" name="email" value="{{ $email }}"
                                            class="form-control form-control-user" id="exampleInputEmail"
                                            aria-describedby="emailHelp" autocomplete="email">
                                        <input hidden type="text" name="token" value="{{ $token }}">
                                    </div>

                                    <!-- OTP Input Field -->
                                    <fieldset class="form-group position-relative has-icon-left">
                                        <input type="text" name="otp" value="{{ old('otp') }}"
                                            class="form-control form-control-lg input-lg @error('otp') is-invalid @enderror"
                                            placeholder="Enter OTP Code" autocomplete="off" maxlength="6">
                                        @error('otp')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <div class="form-control-position">
                                            <i class="ft-shield"></i>
                                        </div>
                                    </fieldset>

                                    <!-- Submit Button -->
                                    <button type="submit" class="btn btn-outline-info btn-lg btn-block">
                                        <i class="ft-check"></i> Verify OTP
                                    </button>
                                </form>

                                <!-- Resend OTP Form -->
                                <div class="text-center mt-3">
                                    <p class="text-muted">Didn't receive the code?</p>
                                    <form action="{{ route('dashboard.password.resend-otp') }}" method="POST"
                                        style="display: inline;">
                                        @csrf
                                        <input type="hidden" name="email" value="{{ $email }}">
                                        <input type="hidden" name="token" value="{{ $token }}">
                                        <button type="submit" class="btn btn-link">
                                            <i class="ft-refresh-cw"></i> Resend OTP
                                        </button>
                                    </form>
                                </div>
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
