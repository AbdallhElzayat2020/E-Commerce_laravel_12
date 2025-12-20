@extends('frontend.layouts.master')

@section('title', 'Checkout')

@section('content')
    <section class="blog about-blog">
        <div class="container">
            <div class="blog-bradcrum">
                <span><a href="{{ route('website.home') }}">Home</a></span>
                <span class="devider">/</span>
                <span><a href="javascript:void(0)">Checkout</a></span>
            </div>
            <div class="blog-heading about-heading">
                <h1 class="heading">Checkout</h1>
            </div>
        </div>
    </section>


    <section class="checkout product footer-padding">
        <div class="container">
            <div class="checkout-section">
                <div class="row gy-5">

                    {{-- shipping address --}}
                    <div class="col-lg-6">
                        @livewire('website.checkout.shipping-details')
                    </div>

                    {{-- cart details --}}
                    <div class="col-lg-6">
                        @livewire('website.checkout.order-summary')

                        {{-- coupon --}}
                        <div class="review-form">
                            @livewire('website.checkout.coupons')
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
